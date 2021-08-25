<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoreReqestSuccessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('score_reqest_success', function (Blueprint $table) {
            $table->increments('id');
            $table->string('student_id')->nullale();
            $table->integer('score')->default(0);
            $table->string('passed_courses')->nullale();
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
        Schema::dropIfExists('score_reqest_success');
    }
}
