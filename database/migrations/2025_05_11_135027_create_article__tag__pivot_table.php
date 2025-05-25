<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('article_tag_pivot', function (Blueprint $table) {
            $table->foreignId('article_id')->constrained('articles', 'article_id')->onDelete('cascade');
            $table->foreignId('tag_id')->constrained('tags', 'tag_id')->onDelete('cascade');
            $table->timestamps();

            // Create a composite primary key
            $table->primary(['article_id', 'tag_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('article_tag_pivot');
    }
};
