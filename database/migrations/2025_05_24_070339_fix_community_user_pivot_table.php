<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, check which table actually exists
        if (Schema::hasTable('community_user_pivot') && !Schema::hasTable('community_user_pivots')) {
            // If only the singular version exists, rename it
            Schema::rename('community_user_pivot', 'community_user_pivots');

            // Add role column to the newly renamed table
            Schema::table('community_user_pivots', function (Blueprint $table) {
                $table->string('role')->default('member')->after('tg_gabung');
            });
        }
        // If the plural version already exists
        elseif (Schema::hasTable('community_user_pivots')) {
            // Just add the role column if it doesn't exist
            if (!Schema::hasColumn('community_user_pivots', 'role')) {
                Schema::table('community_user_pivots', function (Blueprint $table) {
                    $table->string('role')->default('member')->after('tg_gabung');
                });
            }
        }
        // If neither exists (unlikely, but possible), create the correct table
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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // We don't want to delete the table or rename it back in down()
        // Just remove the role column if we added it
        if (Schema::hasTable('community_user_pivots') && Schema::hasColumn('community_user_pivots', 'role')) {
            Schema::table('community_user_pivots', function (Blueprint $table) {
                $table->dropColumn('role');
            });
        }
    }
};
