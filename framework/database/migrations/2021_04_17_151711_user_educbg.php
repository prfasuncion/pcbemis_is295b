<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserEducbg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_educbg', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('level');
            $table->string('school');
            $table->string('degree');
            $table->string('ed_from');
            $table->string('ed_to');
            $table->string('units_earned');
            $table->string('year_graduated');
            $table->string('award');
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
        Schema::dropIfExists('user_educbg');
    }
}
