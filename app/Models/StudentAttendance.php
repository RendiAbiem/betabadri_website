<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    protected $guarded = [];

    public function student() { return $this->belongsTo(Student::class); }
    public function journal() { return $this->belongsTo(TeachingJournal::class, 'teaching_journal_id'); }
}
