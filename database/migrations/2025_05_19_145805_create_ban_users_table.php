<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('ban_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('community_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('banned_by');
            $table->timestamp('banned_at');
            $table->string('reason')->nullable();
            $table->timestamps();

            $table->foreign('community_id')->references('community_id')->on('communities')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('banned_by')->references('user_id')->on('users')->onDelete('cascade');

            $table->unique(['community_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ban_users');
    }
};
