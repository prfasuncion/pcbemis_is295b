<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class employee_categ_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('employee_category')->insert([
           
            'category' => 'Teaching',
            'created_at' => now(),
            'updated_at' => now()
        ]);
         DB::table('employee_category')->insert([
           
            'category' => 'Non-Teaching',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
