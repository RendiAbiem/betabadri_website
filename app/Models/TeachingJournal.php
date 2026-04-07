<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeachingJournal extends Model
{
    protected $guarded = [];

    public function attendances() {
        return $this->hasMany(StudentAttendance::class);
    }

    public function school() { return $this->belongsTo(School::class); }
    public function mentor() { return $this->belongsTo(User::class, 'user_id'); }
    public function program() { return $this->belongsTo(Program::class); }
}
