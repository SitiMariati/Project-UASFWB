<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
    {
        Schema::create('Users', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->unique();
           $table->string('password');
            $table->enum('role', ['admin', 'petugas', 'user'])->default('user');
            $table->rememberToken();
            $table->timestamps();
        });
 }
 
    public function down()
    {
        Schema::dropIfExists('Users');
    }
};
