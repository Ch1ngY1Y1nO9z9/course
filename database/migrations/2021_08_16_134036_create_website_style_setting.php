<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsiteStyleSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_setting_style', function (Blueprint $table) {
            $table->integer('id')->unsigned()->autoIncrement();
            $table->string('main_navbar_bg_color', 255)->nullable();
            $table->string('more_navbar_bg_color', 255)->nullable();
            $table->string('footer_bg_color', 255)->nullable();
            $table->string('content_page_bg_img', 255)->nullable();
            $table->string('background_size', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('website_setting_style');
    }
}
