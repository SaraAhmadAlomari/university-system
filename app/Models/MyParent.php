<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyParent extends Model
{
    use HasFactory;
    protected $table = 'my_parents'; // Explicitly define the table name
    
    protected $guarded=[];
    protected $casts = [
        'first_name' => 'array',
        'last_name' => 'array',
        'address' => 'array',
        'relation' => 'array',

    ];

    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id');
    }

    public function relegion()
    {
        return $this->belongsTo(Religion::class, 'relegion_id');
    }
}
