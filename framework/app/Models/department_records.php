<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class department_records extends Model
{
    use HasFactory;


    public $table = "department_records";

        protected $fillable = [
        'dept_id',
        'user_id',
        'until'
        
    ];
}
