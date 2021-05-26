<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sem extends Model
{
    use HasFactory;

	public $table = "sem";

    protected $fillable = [
        'name','ay_id'
    ];
 
}
