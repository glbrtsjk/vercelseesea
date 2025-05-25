<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('community_user_pivot', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->foreignId('community_id')->constrained('communities', 'community_id')->onDelete('cascade');
            $table->date('tg_gabung');
            $table->timestamps();
            $table->primary(['user_id', 'community_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('community_user_pivot');
    }
};

