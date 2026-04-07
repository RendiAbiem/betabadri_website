<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];

    // --- PASTIKAN INI ADA ---
    // Agar Payment tahu siapa pemiliknya
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
