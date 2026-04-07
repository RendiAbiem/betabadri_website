<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    // Data profil sekolah saja
    protected $guarded = [];
    // Atau: protected $fillable = ['name', 'address', 'pic_name', 'pic_phone'];

    // Relasi: 1 Sekolah punya banyak Program
    public function programs()
    {
        return $this->hasMany(Program::class);
    }

    // Relasi: 1 Sekolah punya banyak Siswa
    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
