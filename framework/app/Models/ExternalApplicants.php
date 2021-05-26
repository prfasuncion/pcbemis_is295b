<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExternalApplicants extends Model
{

    public $table = "external_applicants";
    use HasFactory;
   

      protected $fillable = [
        'email',
        'bday',
        'job_id',
        'contact',
        'lname',
        'fname', 
        'mname', 
        'name_ext',
        'brgy',
        'city',
        'province',
        'street',
        'intent',
        'image',
        'resume'

        
    ];
}
