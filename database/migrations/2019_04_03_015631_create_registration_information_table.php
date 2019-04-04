<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration_information', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('status');
            $table->time('time_begin');
            $table->date('date_begin');
            $table->time('time_finish');
            $table->date('date_finish');
            $table->integer('min_credits');
            $table->integer('max_credits');
            $table->bigInteger('admin_id');
            $table->bigInteger('department_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registration_information');
    }
}
