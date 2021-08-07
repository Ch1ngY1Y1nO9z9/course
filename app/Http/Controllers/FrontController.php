<?php

namespace App\Http\Controllers;

use App\Article;
use App\ImageNews;
use App\PlanArticle;
use App\PlanPage;
use App\Seo;
use App\Links;
use App\Slider;
use App\WebCount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class FrontController extends Controller
{

    public function __construct()
    {
        $this->index='front.index';
        $this->activity_calendar='front.activity_calendar';

    }

    //首頁
    public function index()
    {
        $this->addWebCount();

        $seo = Seo::where('page','index')->first();

        $seo_all=Seo::all();
        $about = $seo_all->where('page','about')->first();
        $about_2 = $seo_all->where('page','about_2')->first();
        $banners = Slider::OrderBy('sort','desc')->get();
        $links = Links::OrderBy('sort','desc')->get();

        $news = Article::where('type',1)->OrderBy('date','desc')->take(5)->get();
        $downloads = Article::where('type',5)->OrderBy('date','desc')->take(3)->with('download_files')->get();
        $videos = Article::where('type',4)->OrderBy('date','desc')->take(6)->with('download_files')->get();

        return view($this->index,compact('seo','about','about_2','news','banners','downloads','links','videos'));
    }

    public function plan_cp(Request $request)
    {
        $seo = Seo::where('page','index')->first();
        $banners = Slider::OrderBy('sort','desc')->get();
        $links = Links::OrderBy('sort','desc')->get();

        $this->addWebCount();

        $route_name = Route::currentRouteName();
        switch ($route_name){
            case 'plan_vision':
                $PlanPageID = 1;
                break;
            case 'organization':
                $PlanPageID = 2;
                break;
            case 'usr_committee':
                $PlanPageID = 3;
                break;
            case 'office_member':
                $PlanPageID = 4;
                break;
            case 'results_report':
                $PlanPageID = 5;
                break;
            case 'shi_gang':
                $PlanPageID = 6;
                break;
        }

        $page = PlanPage::find($PlanPageID);
        return view('front._cp',compact('page','seo','banners','links'));
    }

    //article view
    public function article_view(Request $request)
    {
        $user_ip = $this->getUserIP();
        $value = Session::get('userIp');
        if($value==null){
            WebCount::create(['ip'=>$user_ip]);
            session(['userIp' => '$user_ip']);
        }

        $route_name = Route::currentRouteName();

        $seo=Seo::where('page','news')->first();
        $banners = Slider::OrderBy('sort','desc')->get();
        $links = Links::OrderBy('sort','desc')->get();

        $viewName = "";

        switch ($route_name){
            case 'front_news':
                $article_type = 1;
                $viewName = "front.news";
                break;

            case 'front_plan_results':
                $article_type = 2;
                $viewName = "front.plan_results";
                break;

            case 'front_video':
                $article_type = 4;
                $viewName = "front.video";
                break;

            case 'front_downloads':
                $article_type = 5;
                $viewName = "front.downloads";
                break;

        }

        $q = Article::where('type',$article_type);

        if($article_type==5){
            $q->with('download_files');
        }

        if($request->all_check == 'on'){
            if ($request->has('years') && $request->years!=null)
            {
                // simple where here or another scope, whatever you like
                $o_years=$request->years;
                $years=(int)str_replace(' ', '', $o_years);
                $q->whereYear('date', '=', $years+1911);
            }

            if ($request->has('type') && $request->type!=null)
            {
                $q->where('plan_type', $request->get('type'));
            }

            if ($request->has('key_words') && $request->key_words!=null)
            {
                $q->where('title','LIKE', '%'.$request->get('key_words').'%');
            }

            if ($request->has('start_date') && $request->start_date!=null)
            {
                $q->where('date', '>=',  $request->get('start_date'));
            }

            if ($request->has('end_date') && $request->end_date!=null)
            {
                $q->where('date', '<=',  $request->get('end_date'));
            }
        }else{

            $q->where(function ($q) use ($request){
                if ($request->has('years') && $request->years!=null)
                {
                    // simple where here or another scope, whatever you like
                    $o_years=$request->years;
                    $years=(int)str_replace(' ', '', $o_years);

                    $q->orWhere(function ($q) use ($years){
                        $q->whereYear('date', '=', $years+1911);
                    });
                }

                if ($request->has('type') && $request->type!=null)
                {
                    $q->orwhere('plan_type', $request->get('type'));
                }

                if ($request->has('key_words') && $request->key_words!=null)
                {
                    $q->orwhere('title','LIKE', '%'.$request->get('key_words').'%');
                }

                if ($request->has('start_date') && $request->start_date!=null)
                {
                    $q->orwhere('date', '>=',  $request->get('start_date'));
                }

                if ($request->has('end_date') && $request->end_date!=null)
                {
                    $q->orwhere('date', '<=',  $request->get('end_date'));
                }
            });
        }

        $articles =  $q->orderBy('top','desc')->orderBy('date','desc')->paginate(6);

        return view($viewName ,compact('seo','banners','links','articles','route_name'));
    }

    //article detail
    public function article_detail(Request $request,$id)
    {
        $user_ip = $this->getUserIP();
        $value = Session::get('userIp');
        if($value==null){
            WebCount::create(['ip'=>$user_ip]);
            session(['userIp' => '$user_ip']);
        }

        $route_name = Route::currentRouteName();

        $article = Article::find($id);

        $seo=Seo::where('page','news')->first();
        $banners = Slider::OrderBy('sort','desc')->get();
        $links = Links::OrderBy('sort','desc')->get();

        return view('front.article_detail',compact('seo','banners','links','route_name','article'));
    }

    //活動行事曆
    public function activity_calendar()
    {
        $user_ip = $this->getUserIP();
        $value = Session::get('userIp');
        if($value==null){
            WebCount::create(['ip'=>$user_ip]);
            session(['userIp' => '$user_ip']);
        }

        $seo=Seo::where('page','activity_calendar')->first();
        $banners = Slider::OrderBy('sort','desc')->get();
        $links = Links::OrderBy('sort','desc')->get();
        
        return view($this->activity_calendar,compact('seo','banners','links'));
    }

    
    function addWebCount()
    {
        $user_ip = $this->getUserIP();
        $value = Session::get('userIp');
        if($value==null){
            WebCount::create(['ip'=>$user_ip]);
            session(['userIp' => '$user_ip']);
        }
    }
    

    function getUserIP()
    {
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        } elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        } else {
            $ipaddress = 'UNKNOWN';
        }
        return $ipaddress;
    }
}
