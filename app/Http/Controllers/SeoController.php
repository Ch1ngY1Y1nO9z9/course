<?php

namespace App\Http\Controllers;

use App\Seo;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function index()
    {
        $seo_all=Seo::all();

        $seo_default = $seo_all->where('page','default')->first();
        $seo_index = $seo_all->where('page','index')->first();
        $seo_news = $seo_all->where('page','news')->first();
        $seo_plan_results = $seo_all->where('page','plan_results')->first();
        $seo_video = $seo_all->where('page','video')->first();
        $seo_activity_calendar = $seo_all->where('page','activity_calendar')->first();
        $seo_honors = $seo_all->where('page','honors')->first();
        $seo_downloads = $seo_all->where('page','downloads')->first();
        $seo_publicity_area = $seo_all->where('page','publicity_area')->first();

        return view('admin.seo.index',compact('seo_default','seo_index', 'seo_news', 'seo_plan_results', 'seo_video','seo_activity_calendar','seo_honors','seo_downloads','seo_publicity_area'));
    }

    public function update(Request $request, $page)
    {
        $seo = Seo::where('page',$page)->first();

        $seo->title = $request->title;

        $seo->keywords = $request->keywords;

        $seo->description = $request->description;

        $seo->save();

        return redirect('/admin/seo');
    }
}
