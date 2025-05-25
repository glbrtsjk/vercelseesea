
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('foto_profil')->nullable();
            $table->text('bio')->nullable();
            $table->enum('role', ['user', 'admin'])->default('user');
            $table->boolean('is_banned')->default(false);
            $table->timestamp('banned_at')->nullable();
            $table->unsignedBigInteger('banned_by')->nullable();
            $table->string('banned_reason')->nullable();
            $table->timestamp('last_active_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('banned_by')->references('user_id')->on('users')->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
