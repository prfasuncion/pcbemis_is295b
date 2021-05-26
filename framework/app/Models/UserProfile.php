<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laratrust\Traits\LaratrustUserTrait;
class UserProfile extends Model
{
	 use LaratrustUserTrait;
    use HasFactory;
     public $table = "user_profiles";
    protected $fillable = [
        'user_id',
        'lname',
        'fname',
        'mname',
        'name_ext',
        'date_of_birth',
        'place_of_birth',
        'sex',
        'civil_status',
        'height',
        'weight',
        'blood_type',
        'citizenship',
        'gsis',
        'pagibig',
        'philhealth',
        'sss',
        'tin',
        'tel_no',
        'mobile',
        'res_house_no',
        'res_street',
        'res_village',
        'res_province',
        'res_municipality',
        'res_brgy',
        'res_zipcode',
        'perm_house_no',
        'perm_street',
        'perm_village',
        'perm_province',
        'perm_municipality',
        'perm_brgy',
        'perm_zipcode'
    ];

    public function profile(){
        return $this->belongsTo('App\Models\User','user_id' , 'id');
    }
    
}
