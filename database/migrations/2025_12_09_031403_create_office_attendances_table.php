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
        Schema::create('office_attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Siapa yang absen
            $table->date('date'); // Tanggal absen
            $table->time('clock_in'); // Jam masuk
            $table->time('clock_out')->nullable(); // Jam pulang (bisa kosong dulu)
            $table->text('activity')->nullable(); // Laporan kegiatan (diisi saat pulang)
            $table->string('report_file')->nullable();
            $table->string('status')->default('present'); // Status: present, sick, permit
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('office_attendances');
    }
};
