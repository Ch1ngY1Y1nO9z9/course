<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebsiteStyleSetting extends Model
{
    protected $table = "website_setting_style";
    public $timestamps = false;

    protected $fillable = [
        'main_navbar_bg_color','more_navbar_bg_color','footer_bg_color','content_page_bg_img','background_size'
    ];
}
