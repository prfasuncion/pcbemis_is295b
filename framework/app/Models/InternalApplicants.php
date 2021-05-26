<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternalApplicants extends Model
{
    public $table = "internal_applicants";
    use HasFactory;
   

      protected $fillable = [
        'user_id',
        'job_id',
        'intent'

        
    ];
}
