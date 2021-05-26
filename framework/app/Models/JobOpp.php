<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOpp extends Model
{
	public $table = "job_opps";
    use HasFactory;
   

      protected $fillable = [
        'job_title',
        'job_description',
        'job_qualifications',
        'job_category', 
        'job_salary', 

        
    ];
}
