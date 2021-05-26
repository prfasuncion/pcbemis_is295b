<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserLdi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('user_ldi', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('training');
            $table->date('from');
            $table->date('to');
            $table->string('hours');
            $table->string('type')->nullable();
            $table->string('conducted');
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
        //
    }
}
