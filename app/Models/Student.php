<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $casts = [
        'name' => 'array', // Cast 'name' to an array
    ];
    protected $guarded = [];

    public function faculties()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class, 'student_classroom');
    }

    public function sections()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
    public function nationalies()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id');
    }
    public function genders()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }
    public function religions()
    {
        return $this->belongsTo(Religion::class, 'relegion_id');
    }
    public function parents()
    {
        return $this->belongsTo(MyParent::class,'parent_id');
    }
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'current_grade');
    }
}
