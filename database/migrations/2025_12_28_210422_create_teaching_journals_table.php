<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Kita cek dulu, kalau tabelnya sudah ada (tapi salah), kita hapus dulu
        if (Schema::hasTable('teaching_journals')) {
            Schema::drop('teaching_journals');
        }

        Schema::create('teaching_journals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id'); // ID Mentor
            $table->foreignId('school_id');
            $table->foreignId('program_id');
            $table->string('class_name')->nullable(); // Nama Kelas (Opsional)
            $table->date('date');
            $table->string('topic'); // Materi

            // --- INI YANG KEMARIN LUPA ---
            $table->text('notes')->nullable(); // Catatan
            $table->string('photo_proof')->nullable(); // Foto Dokumentasi
            // -----------------------------

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('teaching_journals');
    }
};
