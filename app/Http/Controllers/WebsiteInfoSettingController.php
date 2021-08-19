<?php

namespace App\Http\Controllers;

use App\WebsiteInfoSetting;
use Illuminate\Http\Request;

class WebsiteInfoSettingController extends Controller
{
    public function index()
    {
        $website_info_setting = WebsiteInfoSetting::find(1);
        
        return view('admin.website_info_setting.index',compact('website_info_setting'));
    }

    public function update(Request $request)
    {
        $website_info_setting = WebsiteInfoSetting::find(1);
        $website_info_setting->update($request->all());

        return redirect()->back();
    }
}
