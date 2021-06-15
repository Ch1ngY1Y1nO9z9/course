<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('class_cn')->nullable();
            $table->string('class_en')->nullable();
            $table->string('budget')->nullable();
            $table->string('class_type')->nullable();
            $table->string('organizer')->nullable();
            $table->string('teacher_name')->nullable();
            $table->string('degree')->nullable();
            $table->string('experience')->nullable();
            $table->string('class_start')->nullable();
            $table->string('class_end')->nullable();
            $table->string('open')->nullable();
            $table->integer('number')->nullable();
            $table->string('sign_up_start_date')->nullable();
            $table->string('sign_up_end_date')->nullable();
            $table->string('location')->nullable();
            $table->integer('total_hours')->nullable();
            $table->integer('credit')->nullable();
            $table->longText('content')->nullable();
            $table->string('contact')->nullable();
            $table->string('phone')->nullable();
            $table->longText('extend')->nullable();
            $table->string('files')->nullable();
            $table->string('remarks')->nullable();
            $table->string('status')->default('待審核');
            $table->integer('user_id')->default(1);
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
        Schema::dropIfExists('courses');
    }
}
