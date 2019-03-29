<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('teacher');
            $table->integer('class_group');
            $table->string('class_room');
            $table->integer('size');
            $table->integer('registered')->default(0);
            $table->bigInteger('subject_id');
            $table->bigInteger('registration_information_id');
            $table->bigInteger('lesson_id');
            $table->bigInteger('semester_id');
            $table->bigInteger('day_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classes');
    }
}
