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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama Program
            $table->enum('payment_type', ['per_siswa', 'spp']); // Tipe Bayar
            $table->decimal('price', 15, 0); // Harga Standar
            $table->decimal('school_fee', 15, 0)->default(0); // Jatah Sekolah
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
