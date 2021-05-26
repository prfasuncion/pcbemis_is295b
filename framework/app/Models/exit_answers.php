<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class exit_answers extends Model
{
    use HasFactory;
   
    public $table = "exit_answers";
    protected $fillable = [
        'user_id',
        'question_id',
        'answer'
       
    ];
}
