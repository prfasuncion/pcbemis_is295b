<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designations extends Model
{
    use HasFactory;
    public $table = "designations";


        protected $fillable = [
        'desig_title',
        'desig_description',
        'dept_id_head'
        
    ];

    public function designee(){
        return $this->hasMany('App\Models\designation_records','desig_id' , 'id');
    }
}
