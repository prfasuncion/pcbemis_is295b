<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class evalresults extends Model
{
    use HasFactory;

    public $table = "evalresults";
    protected $fillable = [
        'eval_set_id',
        'user_id',
        'score',
        'evaluator'

      
    ];
}
