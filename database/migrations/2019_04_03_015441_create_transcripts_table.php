<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTranscriptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transcripts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('attendance_point')->default(0);
            $table->float('test_point')->default(0);
            $table->float('final_exam_point')->default(0);
            $table->float('final_point')->default(0);
            $table->bigInteger('student_id');
            $table->bigInteger('subject_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transcripts');
    }
}
