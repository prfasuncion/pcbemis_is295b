<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class position_type_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('position_types')->insert([
           
            'type' => 'Plantilla',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('position_types')->insert([
           
            'type' => 'Contract of Service',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('position_types')->insert([
           
            'type' => 'Part-time',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
