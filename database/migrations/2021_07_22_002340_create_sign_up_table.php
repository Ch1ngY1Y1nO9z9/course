<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSignUpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sign_up', function (Blueprint $table) {
            $table->increments('id');
            $table->string('course_id');
            $table->string('student_name');
            $table->string('student_id');
            $table->string('academic_year')->nullable();
            $table->string('pass')->default('尚未評分')->nullable();
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
        Schema::dropIfExists('sign_up');
    }
}
