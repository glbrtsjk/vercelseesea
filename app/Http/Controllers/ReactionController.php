<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\CommentReply;
use App\Models\Reaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a new reaction or update existing one using standard form submission.
     */
    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'reactionable_id' => 'required|integer',
            'reactionable_type' => 'required|string|in:App\\Models\\Article,App\\Models\\Comment,App\\Models\\CommentReply',
            'jenis_reaksi' => 'required|string|in:like,love,laugh,sad,angry,wow',
            'redirect_url' => 'required|string',
        ]);

        // Check if the reactionable exists
        $reactionableType = $request->reactionable_type;
        $reactionableId = $request->reactionable_id;

        $exists = $reactionableType::find($reactionableId);
        if (!$exists) {
            return redirect()->back()
                ->with('error', 'The content you are trying to react to does not exist.');
        }

        // Find existing reaction by this user for this content
        $existingReaction = Reaction::where('user_id', Auth::id())
            ->where('reactionable_id', $reactionableId)
            ->where('reactionable_type', $reactionableType)
            ->first();

        $message = '';

        if ($existingReaction) {
            // If same reaction, remove it (toggle off)
            if ($existingReaction->jenis_reaksi == $request->jenis_reaksi) {
                $existingReaction->delete();
                $message = ucfirst($request->jenis_reaksi) . ' reaction removed.';
            } else {
                // If different reaction, update it
                $existingReaction->jenis_reaksi = $request->jenis_reaksi;
                $existingReaction->save();
                $message = 'Reaction changed to ' . $request->jenis_reaksi . '.';
            }
        } else {
            // Create new reaction
            Reaction::create([
                'jenis_reaksi' => $request->jenis_reaksi,
                'user_id' => Auth::id(),
                'reactionable_id' => $reactionableId,
                'reactionable_type' => $reactionableType,
            ]);
            $message = ucfirst($request->jenis_reaksi) . ' reaction added.';
        }

        // Redirect back with success message
        return redirect($request->redirect_url)
            ->with('success', $message)
            ->withFragment(isset($request->fragment) ? $request->fragment : '');
    }

    /**
     * Display the reaction counts for an item.
     */
    public function show(Request $request, $type, $id)
    {
        // Map URL parameters to model classes
        $modelMap = [
            'article' => Article::class,
            'comment' => Comment::class,
            'reply' => CommentReply::class,
        ];

        if (!isset($modelMap[$type])) {
            abort(404);
        }

        $modelClass = $modelMap[$type];
        $item = $modelClass::findOrFail($id);

        // Get users who reacted to this item, grouped by reaction type
        $reactionsByType = $item->reactions()
            ->with('user')
            ->get()
            ->groupBy('jenis_reaksi');

        return view('articles.reaction', [
            'item' => $item,
            'itemType' => $type,
            'reactionsByType' => $reactionsByType
        ]);
    }

    /**
     * Remove a specific reaction.
     */
    public function destroy(Request $request)
    {
        // Validate request data
        $request->validate([
            'reactionable_id' => 'required|integer',
            'reactionable_type' => 'required|string|in:App\\Models\\Article,App\\Models\\Comment,App\\Models\\CommentReply',
            'redirect_url' => 'required|string',
        ]);

        // Delete the reaction
        Reaction::where('user_id', Auth::id())
            ->where('reactionable_id', $request->reactionable_id)
            ->where('reactionable_type', $request->reactionable_type)
            ->delete();

        return redirect($request->redirect_url)
            ->with('success', 'Reaction removed successfully')
            ->withFragment(isset($request->fragment) ? $request->fragment : '');
    }
}
