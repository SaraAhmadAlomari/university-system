<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    use HasFactory;
    protected $casts = [
        'name' => 'array', // Cast 'name' to an array
    ];
    protected $fillable = ['name'];
}
