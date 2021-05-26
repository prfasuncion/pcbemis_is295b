<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;
       public $table = "tasks";
        protected $fillable = [
        'name',
        'description', 
        'due',
        'sem_id'
        
    ];
      public function assigned_details(){
        return $this->hasMany('App\Models\assigned_task', 'task_id');
    }
     public function task_progress(){
        return $this->hasMany('App\Models\task_milestone', 'task_id');
    }

}
