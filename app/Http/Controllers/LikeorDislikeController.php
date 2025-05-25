<?php

namespace App\Http\Controllers;

use App\Models\LikeDislike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeorDislikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a new like/dislike or toggle existing one.
     */
    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'type' => 'required|string|in:like,dislike',
            'model_type' => 'required|string|in:App\\Models\\Article,App\\Models\\Comment,App\\Models\\CommentReply',
            'model_id' => 'required|integer',
            'redirect_url' => 'required|string',
        ]);

        // Check if the model exists
        $modelType = $request->model_type;
        $modelId = $request->model_id;

        $exists = $modelType::find($modelId);
        if (!$exists) {
            return back()->with('error', 'The content you are trying to like/dislike does not exist.');
        }

        // Find existing like/dislike by this user for this content
        $existingLikeDislike = LikeDislike::where('user_id', Auth::id())
            ->where('likeable_id', $modelId)
            ->where('likeable_type', $modelType)
            ->first();

        if ($existingLikeDislike) {
            // If same type, remove it (toggle off)
            if ($existingLikeDislike->type == $request->type) {
                $existingLikeDislike->delete();
                $message = ucfirst($request->type) . ' removed successfully.';
            } else {
                // If different type, update it
                $existingLikeDislike->type = $request->type;
                $existingLikeDislike->save();
                $message = ucfirst($request->type) . ' added successfully.';
            }
        } else {
            // Create new like/dislike
            LikeDislike::create([
                'type' => $request->type,
                'user_id' => Auth::id(),
                'likeable_id' => $modelId,
                'likeable_type' => $modelType,
            ]);
            $message = ucfirst($request->type) . ' added successfully.';
        }

        // Redirect back to the specified URL
        return redirect($request->redirect_url)
            ->with('success', $message)
            ->withFragment(isset($request->fragment) ? $request->fragment : '');
    }

    /**
     * Remove a like/dislike
     */
    public function destroy(Request $request)
    {
        // Validate request data
        $request->validate([
            'model_type' => 'required|string|in:App\\Models\\Article,App\\Models\\Comment,App\\Models\\CommentReply',
            'model_id' => 'required|integer',
            'redirect_url' => 'required|string',
        ]);

        // Delete the like/dislike if it exists
        LikeDislike::where('user_id', Auth::id())
            ->where('likeable_id', $request->model_id)
            ->where('likeable_type', $request->model_type)
            ->delete();

        return redirect($request->redirect_url)
            ->with('success', 'Reaction removed successfully')
            ->withFragment(isset($request->fragment) ? $request->fragment : '');
    }
}
