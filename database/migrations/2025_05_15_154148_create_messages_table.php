<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id('message_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('community_id');
            $table->text('isi_pesan')->nullable();
           $table->timestamp('tgl_pesan');

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('community_id')->references('community_id')->on('communities')->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('messages');

    }
};
