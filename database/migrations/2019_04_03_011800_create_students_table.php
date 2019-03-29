<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('full_name');
            $table->date('birth');
            $table->string('id_card')->unique();
            $table->bigInteger('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('pass')->nullable();
            $table->string('remem_token')->nullable();
            $table->string('avatar')->nullable();
            $table->string('local_address');
            $table->string('current_address')->nullable();
            $table->bigInteger('generations_id');
            $table->bigInteger('departments_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
