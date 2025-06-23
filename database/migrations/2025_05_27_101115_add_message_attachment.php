<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->string('lampiran')->nullable()->after('isi_pesan');
            $table->string('lampiran_nama')->nullable()->after('lampiran');
            $table->string('lampiran_tipe')->nullable()->after('lampiran_nama');

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn('lampiran');
            $table->dropColumn('lampiran_nama');
            $table->dropColumn('lampiran_tipe');

            $table->dropColumn(['created_at', 'updated_at']);
        });
    }
};
