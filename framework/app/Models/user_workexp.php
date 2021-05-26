<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_workexp extends Model
{
   public $table = "user_workexp";
    use HasFactory;
     protected $fillable = [
        'user_id',
        'position',
        'from',
        'to',
        'company',
        'salary',
        'sgrade',
        'appointment',
        'gov_service'
    ];
}
