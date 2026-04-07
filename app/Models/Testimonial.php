<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    // Tambahkan school_id ke fillable
    protected $fillable = [
        'name',
        'role',
        'position',
        'content',
        'image',
        'school_id' // <--- Tambahkan ini
    ];

    // Relasi ke model School
    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
