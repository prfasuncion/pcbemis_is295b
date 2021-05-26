<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class task_milestone extends Model
{
    use HasFactory;
    

    public $table = "task_milestone";
        protected $fillable = [
        'user_id',
        'task_id', 
        'remarks',
        'status'
        
    ];
     
}
