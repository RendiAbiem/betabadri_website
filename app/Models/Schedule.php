<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model {
    protected $guarded = [];
    public function school() { return $this->belongsTo(School::class); }
    public function program() { return $this->belongsTo(Program::class); }
}
