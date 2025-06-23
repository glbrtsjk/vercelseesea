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
            $table->string('jenis_reaksi');
            $table->morphs('reactionable');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['user_id', 'reactionable_id', 'reactionable_type']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('reactions');
    }
};

