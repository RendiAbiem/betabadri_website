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
        Schema::table('office_attendances', function (Blueprint $table) {
            $table->string('image_in')->nullable()->after('clock_in'); // Kolom foto saat masuk
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('office_attendances', function (Blueprint $table) {
            //
        });
    }
};
