<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            
        ]);

        DB::table('user_profiles')->insert([
            'user_id' => 1,
            'lname' => 'Admin',
            'fname' => 'PCBEMIS',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('role_user')->insert([
            'role_id' => 1,
            'user_type' => 'App\Models\User',
            'user_id'=> 1
        ]);

        DB::table('acadyear')->insert([
            'start_ay' => 2020,
            'end_ay'=>2021,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('sem')->insert([
            'name' => 'First Semester',
            'ay_id'=> 1,
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('sem')->insert([
            'name' => 'Second Semester',
            'ay_id'=> 1,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('sem')->insert([
            'name' => 'Mid Year',
            'ay_id'=> 1,
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('eval_category')->insert([
            'name' => 'Teaching',
            'created_at' => now(),
            'updated_at' => now()
         
        ]);
        DB::table('eval_category')->insert([
            'name' => 'Professional Attitude and Behavior',
            'created_at' => now(),
            'updated_at' => now()
         
        ]);
        DB::table('eval_category')->insert([
            'name' => 'Other Involvements',
            'created_at' => now(),
            'updated_at' => now()
         
        ]);


    }
}
