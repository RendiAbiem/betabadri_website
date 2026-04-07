<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');      // Judul (misal: Level 1: Beginner)
            $table->string('category');   // Kategori (modular, electronic, programming)
            $table->text('description');  // Paragraf pembuka
            $table->text('details');      // List item (poin-poin pembelajaran)
            $table->string('image');      // Gambar background
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
