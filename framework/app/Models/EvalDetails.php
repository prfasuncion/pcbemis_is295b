<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvalDetails extends Model
{
    use HasFactory;
    public $table = "eval_details";


        protected $fillable = [
        'eval_categ_id',
        'kpi'

        
    ];
}
