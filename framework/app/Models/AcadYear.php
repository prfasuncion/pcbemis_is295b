<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcadYear extends Model
{
	public $table = "acadyear";
    use HasFactory;

        protected $fillable = [
        'start_ay',
        'end_ay'
        
    ];
     public function ay_details(){
        return $this->hasMany('App\Models\Sem', 'ay_id');
    }

}
