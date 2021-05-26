<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee_categ extends Model
{
    use HasFactory;
    public $table = "employee_category";

    protected $fillable = [
        'category'
    ];
}
