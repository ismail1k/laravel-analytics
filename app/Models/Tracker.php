<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracker extends Model
{
    use HasFactory;

    protected $table = "analytics";
    protected $fillable = [
        'ip',
        'path',
        'source',
        'session_id',
        'user_id',
        'agent',
        'views',
    ];
    protected $hidden = [
        'updated_at',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
