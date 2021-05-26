<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class designation_records extends Model
{
    use HasFactory;
    public $table = "designation_records";


        protected $fillable = [
        'desig_id',
        'user_id',
        'date_designated',
        'until'
        
    ];
}
