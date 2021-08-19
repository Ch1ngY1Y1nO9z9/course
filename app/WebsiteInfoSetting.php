<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebsiteInfoSetting extends Model
{
    protected $table = "website_info_setting";
    public $timestamps = false;

    protected $fillable = [
        'address','office_location','tel','e-mail'
    ];
}
