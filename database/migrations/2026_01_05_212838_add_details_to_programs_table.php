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
        Schema::table('programs', function (Blueprint $table) {

            // 1. Cek dulu apakah kolom school_id sudah ada? Jika belum, baru buat.
            if (!Schema::hasColumn('programs', 'school_id')) {
                $table->foreignId('school_id')->nullable()->constrained('schools')->onDelete('cascade');
            }

            // 2. Cek apakah payment_type sudah ada?
            if (!Schema::hasColumn('programs', 'payment_type')) {
                $table->string('payment_type')->default('Bulanan');
            }

            // 3. Cek apakah school_fee sudah ada?
            if (!Schema::hasColumn('programs', 'school_fee')) {
                $table->decimal('school_fee', 15, 2)->default(0);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            //
        });
    }
};
