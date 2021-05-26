<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class assigned_task extends Model
{
    use HasFactory;
    public $table = "assigned_task";

        protected $fillable = [
        'user_id',
        'task_id', 
        'accepted'
        
    ];
}
