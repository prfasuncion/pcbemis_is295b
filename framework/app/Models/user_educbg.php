<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_educbg extends Model
{
	  public $table = "user_educbg";
    use HasFactory;
     protected $fillable = [
        'user_id',
        'level',
        'school',
        'degree',
        'ed_from',
        'ed_to',
        'units_earned',
        'year_graduated',
        'award'
    ];
}
