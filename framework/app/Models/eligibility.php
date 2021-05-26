<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class eligibility extends Model
{
    use HasFactory;
    public $table = "eligibilities";
     protected $fillable = [
        'user_id',
        'eligibility',
        'rating',
        'date_exam',
        'place',
        'license',
        'validity'
    ];
}
