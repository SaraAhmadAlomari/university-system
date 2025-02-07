<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Spatie\Translatable\HasTranslations;

class Classroom extends Model
{
    use HasFactory;

    protected $casts = [
        'name' => 'array', // Cast 'name' to an array
    ];
    protected $fillable = ['name', 'faculty_id', 'section_id'];

    public function faculties(){
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }
    public function sections(){
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'doctor_classroom');
    }
    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_classroom');
    }
}
