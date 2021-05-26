<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExternalApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('external_applicants', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->date('bday');
            $table->integer('job_id');
            $table->string('contact')->unique();
            $table->string('lname');
            $table->string('fname');
            $table->string('mname')->nullable();
            $table->string('name_ext')->nullable();
            $table->string('brgy');
            $table->string('city');
            $table->string('province');
            $table->string('street')->nullable();
            $table->longtext('intent');
            $table->string('image');
            $table->string('resume');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('external_applicants');
    }
}
