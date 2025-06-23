
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('community_initiative', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('community_id');
            $table->string('judul');
            $table->text('deskripsi');
            $table->integer('urutan_prioritas')->default(0);
            $table->string('icon')->nullable(); 
            $table->timestamps();

            $table->foreign('community_id')->references('community_id')->on('communities')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('community_initiative');
    }
};

