<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            // Menambahkan kolom 'class_name' setelah kolom 'nisn'
            $table->string('class_name')->nullable()->after('nisn');
        });
    }

    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            // Menghapus kolom jika di-rollback
            $table->dropColumn('class_name');
        });
    }
};
