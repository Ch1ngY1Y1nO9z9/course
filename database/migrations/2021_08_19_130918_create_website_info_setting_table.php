<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsiteInfoSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_info_setting', function (Blueprint $table) {
            $table->integer('id')->unsigned()->autoIncrement();
            $table->string('address', 255)->nullable();
            $table->string('office_location', 255)->nullable();
            $table->string('tel', 255)->nullable();
            $table->string('mail', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('website_info_setting');
    }
}
