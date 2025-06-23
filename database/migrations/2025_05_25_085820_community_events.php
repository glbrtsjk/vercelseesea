<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('community_events', function (Blueprint $table) {
            $table->id('event_id');
            $table->unsignedBigInteger('community_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('event_date');
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->string('location')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();

            $table->foreign('community_id')->references('community_id')->on('communities')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('community_events');
    }
};
