<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class position_type extends Model
{
    use HasFactory;
    public $table = "position_types";

    protected $fillable = [
        'type'
    ];
}
