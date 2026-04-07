<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('office_attendances', function (Blueprint $table) {
            // Menambahkan kolom koordinat dan mode kerja
            $table->string('latitude')->nullable()->after('clock_in');
            $table->string('longitude')->nullable()->after('latitude');
            $table->enum('work_mode', ['WFO', 'WFA'])->nullable()->after('status');
        });
    }

    public function down()
    {
        Schema::table('office_attendances', function (Blueprint $table) {
            $table->dropColumn(['latitude', 'longitude', 'work_mode']);
        });
    }
};
