<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class interview_questions extends Model
{
    use HasFactory;
    public $table = "interview_questions";

      protected $fillable = ['question'];
}
