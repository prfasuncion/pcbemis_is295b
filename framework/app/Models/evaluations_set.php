<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class evaluations_set extends Model
{
    use HasFactory;
    public $table = "evaluations_sets";
        protected $fillable = [
        'eval_id',
        'kpi_id',
       
    ];
}
