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
         Schema::create('chapters', function (Blueprint $table) {
             $table->id();
             $table->integer('number_chapter');
             $table->string('image')->nullable();
             $table->unsignedBigInteger('manga_id'); // Foreign key
             $table->foreign('manga_id')->references('id')->on('mangas')->onDelete('cascade');
             $table->string('manga_name')->nullable();
             $table->timestamps();
         });
     }
     

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapters');
    }
};
