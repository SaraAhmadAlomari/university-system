<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Faculty extends Model
{
    use HasFactory;
    // Define the $casts property to automatically cast the 'name' column to an array
    protected $casts = [
        'name' => 'array', // Cast 'name' to an array
    ];
    protected $fillable=['name','note'];

    public function classrooms()
    {
        return $this->hasMany(Classroom::class, 'id');
    }


}
