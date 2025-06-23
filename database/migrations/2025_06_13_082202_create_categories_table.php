<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        if (!Schema::hasColumn('categories', 'gambar_kategori')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->string('gambar_kategori')->nullable()->after('deskripsi');
            });
        }
    }

    
    public function down(): void
    {
        if (Schema::hasColumn('categories', 'gambar_kategori')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->dropColumn('gambar_kategori');
            });
        }
    }
};
