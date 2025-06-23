<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('funfacts', function (Blueprint $table) {
            $table->boolean('is_highlighted')->default(false)->after('gambar');

            $table->renameColumn('deskripsi_id', 'deskripsi');

            $table->dropColumn('deskripsi_en');
        });
    }


    public function down(): void
    {
        Schema::table('funfacts', function (Blueprint $table) {
            $table->dropColumn('is_highlighted');

            $table->renameColumn('deskripsi', 'deskripsi_id');

            $table->text('deskripsi_en')->nullable()->after('deskripsi_id');
        });
    }
};
