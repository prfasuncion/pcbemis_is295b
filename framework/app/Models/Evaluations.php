<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluations extends Model
{
    use HasFactory;
    public $table = "evaluations";
        protected $fillable = [
        'sem_id',
        'status',
        'published',
        'released',
    ];
    public function kpi_set(){
        return $this->hasMany('App\Models\evaluations_set', 'eval_id');
    }
}
