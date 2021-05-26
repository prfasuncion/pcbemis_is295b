<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSelfService extends Model
{
    use HasFactory;
    
    public $table = "user_self_services";

    protected $fillable = [
        'user_id',
        'document',
        'purpose',
        'status',
        'released',
        'remarks'
    ];
}
