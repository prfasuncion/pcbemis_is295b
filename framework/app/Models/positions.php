<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class positions extends Model
{
    use HasFactory;
    public $table = "positions";
    protected $fillable = [
    	'position',
        'type',
        'categ_id'
    ];
}
