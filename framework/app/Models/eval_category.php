<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class eval_category extends Model
{
    use HasFactory;
    public $table = "eval_category";


        protected $fillable = [
        'name',

        
    ];
}
