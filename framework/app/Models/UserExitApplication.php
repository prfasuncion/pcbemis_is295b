<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExitApplication extends Model
{
    use HasFactory;
  

    public $table = "user_exit_applications";

    protected $fillable = [
        'user_id',
        'status',
        'letter',
        'remarks',
        'approved'
    ];
}
