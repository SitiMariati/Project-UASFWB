<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
       Schema::create('jadwal_tayangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('film_id')->constrained('film')->onDelete('cascade');
            $table->dateTime('waktu_tayang');
            $table->timestamps();
        });
  
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_tayangs'); 
    }
};
