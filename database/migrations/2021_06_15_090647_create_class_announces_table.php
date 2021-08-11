<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassAnnouncesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_announces', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('class_id')->nullable();
            $table->string('title')->nullable();
            $table->longText('content')->nullable();
            $table->string('files')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->integer('soft_delete')->default('0')->nullable();
            $table->integer('pushed')->default('0')->nullable();
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
        Schema::dropIfExists('class_announces');
    }
}
