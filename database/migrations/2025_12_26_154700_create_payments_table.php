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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');

            // Menyimpan tipe program saat transaksi terjadi (Snapshot)
            $table->string('payment_type_snapshot');

            $table->decimal('amount', 15, 0); // Tagihan Awal
            $table->decimal('discount', 15, 0)->default(0); // Diskon
            $table->decimal('final_amount', 15, 0); // Uang Masuk (Amount - Discount)
            $table->decimal('school_fee_generated', 15, 0)->default(0); // Expense Fee Sekolah

            // Status Uang: 'paid' (di Kas Kita) atau 'pending_remittance' (di Sekolah)
            $table->enum('status', ['paid', 'pending_remittance'])->default('paid');

            $table->date('payment_date');
            $table->string('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
