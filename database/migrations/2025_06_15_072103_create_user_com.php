<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{

    public function up(): void
    {
        if (!Schema::hasColumn('community_user_pivots', 'aktif_flag')) {
            Schema::table('community_user_pivots', function (Blueprint $table) {
                $table->boolean('aktif_flag')->default(true)->after('role');
            });

            DB::table('community_user_pivots')->update(['aktif_flag' => true]);
        }

        if (!Schema::hasColumn('community_user_pivots', 'terakhir_aktif')) {
            Schema::table('community_user_pivots', function (Blueprint $table) {
                $table->timestamp('terakhir_aktif')->nullable()->after('aktif_flag');
            });

            DB::table('community_user_pivots')->update(['terakhir_aktif' => now()]);
        }
    }

    
    public function down(): void
    {
        Schema::table('community_user_pivots', function (Blueprint $table) {
            if (Schema::hasColumn('community_user_pivots', 'aktif_flag')) {
                $table->dropColumn('aktif_flag');
            }

            if (Schema::hasColumn('community_user_pivots', 'terakhir_aktif')) {
                $table->dropColumn('terakhir_aktif');
            }
        });
    }
};
