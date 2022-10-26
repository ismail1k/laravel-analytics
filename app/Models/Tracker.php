<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracker extends Model
{
    use HasFactory;
    
    protected $table = "traffics";
    protected $fillable = [
        'ip',
        'user',
        'user-agent',
        'path',
    ];
    protected $hidden = [
        'updated_by',
    ];
}
