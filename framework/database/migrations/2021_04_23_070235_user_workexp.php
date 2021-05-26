<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserWorkexp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_workexp', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('position');
            $table->date('from');
            $table->date('to');
            $table->string('company');
            $table->string('salary');
            $table->string('sgrade')->nullable();
            $table->string('appointment')->nullable();
            $table->integer('gov_service');
            $table->timestamps();
        });
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_workexp');
    }
}
