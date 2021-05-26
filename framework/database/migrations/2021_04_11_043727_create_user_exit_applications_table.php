<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserExitApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_exit_applications', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('status')->nullable();
            $table->longtext('letter');
            $table->longtext('remarks')->nullable();
            $table->date('approved')->nullable();
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
        Schema::dropIfExists('user_exit_applications');
    }
}
