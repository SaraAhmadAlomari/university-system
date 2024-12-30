<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $casts = [
        'name' => 'array', // Cast 'name' to an array
    ];
    protected $fillable = ['name', 'faculty_id','classroom_id','status'];

    public function faculties()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }

}
