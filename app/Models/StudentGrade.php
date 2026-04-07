<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGrade extends Model
{
    use HasFactory;

    // --- TAMBAHKAN BAGIAN INI ---
    protected $fillable = [
        'user_id',
        'student_id',
        'program_id',
        'project_name',
        'score_attitude',
        'score_skill',
        'score_knowledge',
        'notes',
    ];
    // ----------------------------

    // Relasi (Opsional, untuk mempermudah pengambilan data nanti)
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function mentor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
