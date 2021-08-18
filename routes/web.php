<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//前端

Route::get('/testmail','CourseClassController@testqueue');

Route::get('/','FrontController@index');

Route::get('/plan_vision','FrontController@plan_cp')->name('plan_vision');
Route::get('/organization','FrontController@plan_cp')->name('organization');
Route::get('/usr_committee','FrontController@plan_cp')->name('usr_committee');
Route::get('/office_member','FrontController@plan_cp')->name('office_member');
Route::get('/results_report','FrontController@plan_cp')->name('results_report');

Route::get('/plan_location','FrontController@plan_cp')->name('shi_gang');

//最新消息
Route::get('/news','FrontController@article_view')->name('front_news');
Route::get('/news/{id}','FrontController@article_detail')->name('front_news_detail');

//成果專區
Route::get('/plan_results','FrontController@article_view')->name('front_plan_results');
Route::get('/plan_results/{id}','FrontController@article_detail')->name('front_plan_results_detail');

//媒體頻道
Route::get('/video','FrontController@article_view')->name('front_video');

//課程專區
Route::get('/course','FrontController@article_view')->name('front_course');
Route::get('/course/{id}','FrontController@article_detail')->name('front_course_detail');

//下載專區
Route::get('/downloads','FrontController@article_view')->name('front_downloads');


Route::get('/activity_calendar','FrontController@activity_calendar');
Route::get('/calendar_api',function (){
    $calendar_day = \App\Article::where('type',1)->where('plan_type','課程公告')->select('id','title','date')->get()->toArray();
    return response(json_encode( $calendar_day, JSON_UNESCAPED_UNICODE))->header('Content-Type', 'application/json');
});

Route::get('/calendar_api2',function (){
    $calendar_day = \App\Article::where('type',1)->where('plan_type','校內活動')->select('id','title','date')->get()->toArray();
    return response(json_encode( $calendar_day, JSON_UNESCAPED_UNICODE))->header('Content-Type', 'application/json');
});

Route::get('/calendar_api3',function (){
    $calendar_day = \App\Article::where('type',1)->where('plan_type','場域活動')->select('id','title','date')->get()->toArray();
    return response(json_encode( $calendar_day, JSON_UNESCAPED_UNICODE))->header('Content-Type', 'application/json');
});

Route::get('/calendar_detail_api/{id}',function ($id){
    $article = \App\Article::where('id',$id)->select('content')->first();
    return view('front.calendar_detail_api',compact('article'));
});

//查詢用
Route::post('/search/{type}','SearchController@search');


//Auth 後台登入用
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
$this->get('register', 'Auth\RegisterController@showRegistrationForm');
$this->post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
// $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
// $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
// $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
// $this->post('password/reset', 'Auth\ResetPasswordController@reset');

// 學生
Route::group(['prefix' => 'micro-course','middleware' => 'auth'], function () {
    //reset password
    $this->get('/reset_password', 'AdminController@get_reset_password');
    $this->post('/reset_password', 'AdminController@reset_password');

    // dashboard
    $this->get('/dashboard', 'AdminController@dashboard');

    // student_course
    Route::get('/student/course', 'CourseClassController@student_index');
    Route::get('/student/course/check/{id}', 'CourseClassController@student_check');

    // student_course_records
    Route::get('/student/course_records', 'CourseClassController@records_index');
    Route::get('/student/course_records/check/{id}', 'CourseClassController@records_check');
    Route::get('/student/course_records/announce/{id}', 'CourseClassController@announce');
    Route::get('/student/course_records/announce/{id}/check', 'CourseClassController@announce_check');
    
    // // student_class_announcement
    // Route::get('/student/class_announcement', 'ClassAnnouncementController@student_index');
    // Route::get('/student/class_announcement/check/{id}', 'ClassAnnouncementController@student_check');

    Route::get('/qrcode/rollcall/{id}','ClassController@student_roll_call');
    Route::get('/qrcode/rollcall_status','ClassController@student_roll_call_status');   
});

// 管理員&教師
Route::group(['prefix' => 'micro-course','middleware' => 'auth'], function () {
    //reset password
    $this->get('/reset_password', 'AdminController@get_reset_password');
    $this->post('/reset_password', 'AdminController@reset_password');

    // // class_announcement
    // Route::get('/class_announcement', 'ClassAnnouncementController@index');
    // Route::get('/class_announcement/create', 'ClassAnnouncementController@create');
    // Route::get('/class_announcement/edit/{id}', 'ClassAnnouncementController@edit');
    // Route::post('/class_announcement/store', 'ClassAnnouncementController@store');
    // Route::post('/class_announcement/update/{id}', 'ClassAnnouncementController@update');
    // Route::post('/class_announcement/delete/{id}', 'ClassAnnouncementController@delete');
    // Route::post('/class_announcement/totop/{id}', 'ClassAnnouncementController@totop');

    // course_records
    Route::get('/course', 'CourseClassController@index');
    Route::get('/course/detail/{id}', 'CourseClassController@detail');
    Route::get('/course/class_detail/{class_id}', 'CourseClassController@class_detail');
    Route::get('/course/export', 'CourseClassController@export');

    Route::post('/course/export_query', 'CourseClassController@export_query');

    // tutorial
    Route::get('/tutorial','TutorialController@index');
    Route::get('/tutorial/create','TutorialController@create');
    Route::get('/tutorial/edit/{id}','TutorialController@edit');
    Route::post('/tutorial/store','TutorialController@store');
    Route::post('/tutorial/update/{id}','TutorialController@update');
    Route::post('/tutorial/delete/{id}','TutorialController@delete');

    // class
    Route::get('/class', 'ClassController@index');
    Route::get('/class/create', 'ClassController@create');
    Route::get('/class/check/{id}', 'ClassController@check');
    Route::get('/class/edit/{id}', 'ClassController@edit');
    Route::get('/class/check/{id}/students', 'ClassController@check_students');
    Route::get('/class/check/{id}/rollCall', 'ClassController@rollCall');
    Route::get('/class/check/{id}/rollCall_records', 'ClassController@rollCall_records');
    Route::get('/class/check/{id}/rollCall_records/check', 'ClassController@rollCall_records_check');
    Route::get('/class/check/{id}/rollCall_records/edit', 'ClassController@rollCall_records_edit');
    Route::get('/class/announce/{id}', 'ClassController@announce');
    Route::get('/class/announce/{id}/create', 'ClassController@announce_create');
    Route::get('/class/announce/{id}/edit', 'ClassController@announce_edit');
    Route::get('/class/assessment/{id}', 'ClassController@assessment');
    Route::post('/class/assessment/{id}/store', 'ClassController@assessment_store');
    Route::get('/class/roll_call_online/{id}', 'ClassController@roll_call_online');
    
    Route::post('class/store', 'ClassController@store');
    Route::post('class/update/{id}', 'ClassController@update');
    Route::post('class/delete/{id}', 'ClassController@delete');
    Route::post('class/copy/{id}', 'ClassController@copy');
    Route::post('class/announce/store', 'ClassController@announce_store');
    Route::post('/class/check/{id}/QRCode_generate', 'ClassController@QRCode_generate');
    Route::post('/class/check/{id}/rollCall_records/update', 'ClassController@rollCall_records_update');
    
    // 報名
    Route::get('class/signup/{id}', 'ClassController@sign_up');
    Route::post('class/signup/delete/{id}', 'ClassController@remove_sign_up');
        
    // class_review
    Route::get('/class_review', 'ClassController@review');
    Route::get('/class_review/check/{id}', 'ClassController@review_check');
    Route::post('/class_review/{id}/{result}', 'ClassController@review_result');

    // fail
    Route::get('/fail', 'ClassController@fail');
    Route::get('/fail/check/{id}', 'ClassController@fail_check');
    Route::post('fail/delete/{id}', 'ClassController@delete_class');

    // teacher_class
    Route::get('/teacher/class', 'TeacherClassController@index');
    Route::get('/teacher/class/create', 'TeacherClassController@create');
    Route::get('/teacher/class/check/{id}', 'TeacherClassController@check');
    Route::get('/teacher/class/check/{id}/students', 'TeacherClassController@check_students');
    Route::get('/teacher/class/check/{id}/rollCall', 'TeacherClassController@rollCall');
    Route::get('/teacher/class/check/{id}/rollCall_records', 'TeacherClassController@rollCall_records');
    Route::get('/teacher/class/check/{id}/rollCall_records/check', 'TeacherClassController@rollCall_records_check');
    
    
    // Route::get('/teacher/class/edit/{id}', 'TeacherClassController@edit');

    // teacher_class_review
    // Route::get('/teacher/class_review', 'TeacherClassController@review');
    // Route::get('/teacher/class_review/check/{id}', 'TeacherClassController@review_check');
    // Route::get('/teacher/class_review/edit/{id}', 'TeacherClassController@review_edit');

    // teacher_class_fail
    Route::get('/teacher/fail', 'TeacherClassController@fail');
    Route::get('/teacher/fail/check/{id}', 'TeacherClassController@fail_check');

    // class_assessment
    Route::get('/class/assessment/{id}', 'ClassController@assessment');

    //upload image
    Route::post('/img/post','AdminController@image_post');

    //index
    Route::get('/','AdminController@index');

    //about
    Route::get('/about','AdminController@about');
    Route::get('/about','AdminController@about_update');

    //友站連結
    Route::group(['prefix' => 'links'], function () {
        Route::get('/', 'LinksController@index');
        Route::get('/create', 'LinksController@create');
        Route::post('/store', 'LinksController@store');
        Route::get('/edit/{id}', 'LinksController@edit');
        Route::post('/update/{id}', 'LinksController@update');
        Route::post('/delete/{id}', 'LinksController@delete');
    });

    //youtube_video
//    Route::get('/youtube_video','AdminController@youtube_video');
//    Route::post('/youtube_video','AdminController@youtube_video_update');

    //website_style_setting
    Route::get('website_style_setting','WebsiteStyleSettingController@index');
    Route::post('website_style_setting/update','WebsiteStyleSettingController@update');

    //seo
    Route::get('seo','SeoController@index');
    Route::post('seo/update/{page}','SeoController@update');

    //seo
    Route::get('about','SeoController@about');
    Route::post('about/update/{page}','SeoController@update_about');

    //news
    Route::group(['prefix' => 'news'], function () {
        Route::get('/', 'ArticleController@news_index');
        Route::get('/create', 'ArticleController@news_create');
        Route::post('/store', 'ArticleController@news_store');
        Route::get('/edit/{id}', 'ArticleController@news_edit');
        Route::post('/update/{id}', 'ArticleController@news_update');
        Route::post('/delete/{id}', 'ArticleController@news_delete');
    });

    //result
    Route::group(['prefix' => 'result'], function () {
        Route::get('/', 'ArticleController@result_index');
        Route::get('/create', 'ArticleController@result_create');
        Route::post('/store', 'ArticleController@result_store');
        Route::get('/edit/{id}', 'ArticleController@result_edit');
        Route::post('/update/{id}', 'ArticleController@result_update');
        Route::post('/delete/{id}', 'ArticleController@result_delete');
    });

    //honor
    Route::group(['prefix' => 'honor'], function () {
        Route::get('/', 'ArticleController@honor_index');
        Route::get('/create', 'ArticleController@honor_create');
        Route::post('/store', 'ArticleController@honor_store');
        Route::get('/edit/{id}', 'ArticleController@honor_edit');
        Route::post('/update/{id}', 'ArticleController@honor_update');
        Route::post('/delete/{id}', 'ArticleController@honor_delete');
    });

    //video
    Route::group(['prefix' => 'video'], function () {
        Route::get('/', 'ArticleController@video_index');
        Route::get('/create', 'ArticleController@video_create');
        Route::post('/store', 'ArticleController@video_store');
        Route::get('/edit/{id}', 'ArticleController@video_edit');
        Route::post('/update/{id}', 'ArticleController@video_update');
        Route::post('/delete/{id}', 'ArticleController@video_delete');
    });

     //video
     Route::group(['prefix' => 'article_course'], function () {
        Route::get('/', 'ArticleController@course_index');
        Route::get('/create', 'ArticleController@course_create');
        Route::post('/store', 'ArticleController@course_store');
        Route::get('/edit/{id}', 'ArticleController@course_edit');
        Route::post('/update/{id}', 'ArticleController@course_update');
        Route::post('/delete/{id}', 'ArticleController@course_delete');
    });

    //download
    Route::group(['prefix' => 'download'], function () {
        Route::get('/', 'ArticleController@download_index');
        Route::get('/create', 'ArticleController@download_create');
        Route::post('/store', 'ArticleController@download_store');
        Route::get('/edit/{id}', 'ArticleController@download_edit');
        Route::post('/update/{id}', 'ArticleController@download_update');
        Route::post('/delete/{id}', 'ArticleController@download_delete');
    });

    //highlight
    Route::group(['prefix' => 'highlight'], function () {
        Route::get('/', 'ArticleController@highlight_index');
        Route::get('/create', 'ArticleController@highlight_create');
        Route::post('/store', 'ArticleController@highlight_store');
        Route::get('/edit/{id}', 'ArticleController@highlight_edit');
        Route::post('/update/{id}', 'ArticleController@highlight_update');
        Route::post('/delete/{id}', 'ArticleController@highlight_delete');
    });

    //other
    Route::group(['prefix' => 'other'], function () {
        Route::get('/', 'ArticleController@other_index');
        Route::get('/create', 'ArticleController@other_create');
        Route::post('/store', 'ArticleController@other_store');
        Route::get('/edit/{id}', 'ArticleController@other_edit');
        Route::post('/update/{id}', 'ArticleController@other_update');
        Route::post('/delete/{id}', 'ArticleController@other_delete');
    });

    //promote
    Route::group(['prefix' => 'promote'], function () {
        Route::get('/', 'ArticleController@promote_index');
        Route::get('/create', 'ArticleController@promote_create');
        Route::post('/store', 'ArticleController@promote_store');
        Route::get('/edit/{id}', 'ArticleController@promote_edit');
        Route::post('/update/{id}', 'ArticleController@promote_update');
        Route::post('/delete/{id}', 'ArticleController@promote_delete');
    });

    //Article-置頂
    ROute::post('/top/{top}/{id}','ArticleController@to_top');

    //banner
    Route::group(['prefix' => 'banner'], function () {
        Route::get('/', 'BannerController@index');
        Route::get('/create', 'BannerController@create');
        Route::post('/store', 'BannerController@store');
        Route::get('/edit/{id}', 'BannerController@edit');
        Route::post('/update/{id}', 'BannerController@update');
        Route::post('/delete/{id}', 'BannerController@delete');
    });

    //activity
    Route::group(['prefix' => 'activity'], function () {
        Route::get('/', 'ImageNewsController@activity_index');
        Route::get('/create', 'ImageNewsController@activity_create');
        Route::post('/store', 'ImageNewsController@activity_store');
        Route::get('/edit/{id}', 'ImageNewsController@activity_edit');
        Route::post('/update/{id}', 'ImageNewsController@activity_update');
        Route::post('/delete/{id}', 'ImageNewsController@activity_delete');
    });

    //important
    Route::group(['prefix' => 'important'], function () {
        Route::get('/', 'ImageNewsController@important_index');
        Route::get('/create', 'ImageNewsController@important_create');
        Route::post('/store', 'ImageNewsController@important_store');
        Route::get('/edit/{id}', 'ImageNewsController@important_edit');
        Route::post('/update/{id}', 'ImageNewsController@important_update');
        Route::post('/delete/{id}', 'ImageNewsController@important_delete');
    });

    //USR計畫
    Route::group(['prefix' => 'plan_page'],function (){
        Route::get('/{id}','ArticleController@plan_page_index');
        Route::get('/edit/{id}','ArticleController@plan_page_edit');
        Route::post('/update/{id}','ArticleController@plan_page_update');
    });

    //相關法規
    Route::get('plan_page_related_legislation','ArticleController@plan_article_index');
    Route::group(['prefix' => 'plan_article'],function (){
        Route::get('/create','ArticleController@plan_article_create');
        Route::post('/store','ArticleController@plan_article_store');
        Route::get('/edit/{id}','ArticleController@plan_article_edit');
        Route::post('/update/{id}','ArticleController@plan_article_update');
        Route::post('/delete/{id}','ArticleController@plan_article_delete');
    });


});