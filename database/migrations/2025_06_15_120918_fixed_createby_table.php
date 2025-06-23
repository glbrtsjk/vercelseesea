<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Community;
use App\Models\User;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{

    public function up(): void
    {
        $nullCommunities = Community::whereNull('created_by')->get();

        $admin = User::where('role', 'admin')->first();

        if (!$admin) {
            return;
        }

        foreach ($nullCommunities as $community) {
            $firstAdminJoin = DB::table('community_user_pivots')
                ->join('users', 'community_user_pivots.user_id', '=', 'users.user_id')
                ->where('community_user_pivots.community_id', $community->community_id)
                ->where('users.role', 'admin')
                ->orderBy('community_user_pivots.tg_gabung', 'asc')
                ->first();

            if ($firstAdminJoin) {
                $community->created_by = $firstAdminJoin->user_id;
                $community->save();
            } else {
                $community->created_by = $admin->user_id;
                $community->save();
            }
        }
    }


    public function down(): void
    { }
};
