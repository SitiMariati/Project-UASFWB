<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
          Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->string('password');
            $table->string('role')->default('pengguna');
            $table->rememberToken();
            $table->timestamps();
        });
    }
  public function down()
    {
        Schema::dropIfExists('user');
    }

};
