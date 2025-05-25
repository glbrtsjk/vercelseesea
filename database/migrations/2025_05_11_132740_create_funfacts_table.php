<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('funfacts', function (Blueprint $table) {
            $table->id('funfact_id');
            $table->string('judul');
            $table->string('gambar')->nullable();
            $table->text('deskripsi_id');
            $table->text('deskripsi_en')->nullable();
            $table->string('urutan_animasi');
            $table->foreignId('article_id')->constrained('articles', 'article_id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('funfacts');
    }
};
