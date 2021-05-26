<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('users_profile', function (Blueprint $table) {
        //     $table->id();
        //     $table->integer('user_id');
        //     $table->string('lname');
        //     $table->string('fname');
        //     $table->string('mname')->nullable();
        //     $table->string('name_ext')->nullable();
        //     $table->date('date_of_birth')->nullable();
        //     $table->string('place_of_birth')->nullable();
        //     $table->string('sex')->nullable();
        //     $table->string('civil_status')->nullable();
        //     $table->double('height')->nullable();
        //     $table->double('weight')->nullable();
        //     $table->string('blood_type')->nullable();
        //     $table->string('citizenship')->nullable();
        //     $table->string('gsis')->nullable();
        //     $table->string('pagibig')->nullable();
        //     $table->string('philhealth')->nullable();
        //     $table->string('sss')->nullable();
        //     $table->string('tin')->nullable();
        //     $table->string('tel_no')->nullable();
        //     $table->string('mobile')->nullable();
        //     $table->string('res_house_no')->nullable();
        //     $table->string('res_street')->nullable();
        //     $table->string('res_village')->nullable();
        //     $table->string('res_province')->nullable();
        //     $table->string('res_municipality')->nullable();
        //     $table->string('res_brgy')->nullable();
        //     $table->string('res_zipcode')->nullable();
        //     $table->string('perm_house_no')->nullable();
        //     $table->string('perm_street')->nullable();
        //     $table->string('perm_village')->nullable();
        //     $table->string('perm_province')->nullable();
        //     $table->string('perm_municipality')->nullable();
        //     $table->string('perm_brgy')->nullable();
        //     $table->string('perm_zipcode')->nullable();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_profile');
    }
}
