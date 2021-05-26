<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_ldi extends Model
{
    public $table = "user_ldi";
    use HasFactory;
     protected $fillable = [
        'user_id',
        'training',
        'from',
        'to',
        'hours',
        'type',
        'conducted'
    ];
}
