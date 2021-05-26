<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class service_record extends Model
{
    use HasFactory;
      
    public $table = "service_records";

    protected $fillable = [
        'user_id',
        'pos_id',
        'started',
        'end'
    ];
}
