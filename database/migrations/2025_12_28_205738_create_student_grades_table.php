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
        Schema::create('student_grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('program_id');
            $table->foreignId('user_id'); // Mentor penilai
            $table->string('project_name')->nullable(); // Nama Project/Ujian
            $table->integer('score_attitude')->default(0); // Nilai Sikap
            $table->integer('score_skill')->default(0);    // Nilai Keterampilan
            $table->integer('score_knowledge')->default(0); // Nilai Pengetahuan
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_grades');
    }
};
