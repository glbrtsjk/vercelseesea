<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('community_user_pivot') && !Schema::hasTable('community_user_pivots')) {
            Schema::rename('community_user_pivot', 'community_user_pivots');

            Schema::table('community_user_pivots', function (Blueprint $table) {
                $table->string('role')->default('member')->after('tg_gabung');
            });
        }
        elseif (Schema::hasTable('community_user_pivots')) {
            if (!Schema::hasColumn('community_user_pivots', 'role')) {
                Schema::table('community_user_pivots', function (Blueprint $table) {
                    $table->string('role')->default('member')->after('tg_gabung');
                });
            }
        }
        else {
            Schema::create('community_user_pivots', function (Blueprint $table) {
                $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
                $table->foreignId('community_id')->constrained('communities', 'community_id')->onDelete('cascade');
                $table->date('tg_gabung');
                $table->string('role')->default('member');
                $table->timestamps();
                $table->primary(['user_id', 'community_id']);
            });
        }
    }


    public function down(): void
    {
          if (Schema::hasTable('community_user_pivots') && Schema::hasColumn('community_user_pivots', 'role')) {
            Schema::table('community_user_pivots', function (Blueprint $table) {
                $table->dropColumn('role');
            });
        }
    }
};
