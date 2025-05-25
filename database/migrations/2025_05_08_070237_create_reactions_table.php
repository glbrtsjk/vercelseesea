<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reactions', function (Blueprint $table) {
            $table->id('reaction_id');
            $table->string('jenis_reaksi'); // like, love, angry, etc.
            $table->morphs('reactionable');  // For polymorphic relationship (article, comment, reply)
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->timestamps();
            // Ensure one reaction per user per item
            $table->unique(['user_id', 'reactionable_id', 'reactionable_type']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('reactions');
    }
};

