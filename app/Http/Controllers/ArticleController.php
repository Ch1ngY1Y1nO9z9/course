<?php

namespace App\Http\Controllers;

use App\Article;
use App\DownloadFile;
use App\PlanArticle;
use App\PlanPage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    #region 最新消息
    public function news_index()
    {
        $lists =  Article::where('type',1)->get();
        return view('admin.news.index',compact('lists'));
    }

    public function news_create()
    {
        return view('admin.news.create');
    }

    public function news_store(Request $request)
    {
        $new_list = new Article();
        $new_list -> type = 1;
        $new_list -> plan_type = $request->plan_type;
        $new_list -> title = $request->title;
        $new_list -> content = $request-> main_content;
        $new_list -> date = $request-> date;
        $new_list -> schedule = $request-> schedule;
        

        if( $request->hasFile('upload_files')){
            $files = $request->file('upload_files');
            foreach ($files as $file){
                $this->upload_file($file,$new_list->id);
            }
        }

        $new_list -> save();



        return redirect('/micro-course/news')->with('message','新增成功!');
    }

    public function news_edit($id)
    {
        $list = Article::find($id);
        $files = DownloadFile::where('article_id',$id) -> get();

        if($list->type == 1){
            return view('admin.news.edit',compact('list','files'));
        }else {
            return redirect('/micro-course/news')->with('message', '無此文章!');
        }
    }

    public function news_update(Request $request,$id)
    {
        $list = Article::find($id);
        if($list->type == 1){
            $list->plan_type = $request->plan_type;
            $list -> title = $request->title;
            $list -> content = $request-> main_content;
            $list -> date = $request-> date;
            $list -> schedule = $request-> schedule;

            if($request->del_files != null){
                $del_files = $request->del_files;
                foreach ($del_files as $del_file){
                    $this->delete_file($del_file);
                }
            }
            if( $request->hasFile('upload_files')){
                $files = $request->file('upload_files');
                foreach ($files as $file){
                    $this->upload_file($file,$list->id);
                }
            }

            $list -> save();

            return redirect('/micro-course/news')->with('message','修改成功!');
        }else{
            return redirect('/micro-course/news')->with('message', '無此文章!');
        }
    }

    public function news_delete(Request $request,$id)
    {
        $list = Article::find($id);
        $list -> delete();
        return redirect('/micro-course/news')->with('message','刪除成功!');
    }
    #endregion

    #region 成果專區
    public function result_index()
    {
        $lists =  Article::where('type',2)->get();
        return view('admin.result.index',compact('lists'));
    }

    public function result_create()
    {
        return view('admin.result.create');
    }

    public function result_store(Request $request)
    {
        $new_list = new Article();
        $new_list -> type = 2;
        $new_list -> plan_type = $request->plan_type;
        $new_list -> title = $request->title;
        $new_list -> content = $request-> main_content;
        $new_list -> date = $request-> date;
        $new_list -> save();

        if( $request->hasFile('upload_files')){
            $files = $request->file('upload_files');
            foreach ($files as $file){
                $this->upload_file($file,$new_list->id);
            }
        }

        return redirect('/micro-course/result')->with('message','新增成功!');
    }

    public function result_edit($id)
    {
        $list = Article::find($id);
        if($list->type == 2){
            $files = DownloadFile::where('article_id',$id) -> get();
            return view('admin.result.edit',compact('list','files'));
        }else {
            return redirect('/micro-course/result')->with('message', '無此文章!');
        }
    }

    public function result_update(Request $request,$id)
    {
        $list = Article::find($id);
        if($list->type == 2){
            $list->plan_type = $request->plan_type;
            $list -> title = $request->title;
            $list -> content = $request-> main_content;
            $list -> date = $request-> date;
            $list -> save();

            if($request->del_files != null){
                $del_files = $request->del_files;
                foreach ($del_files as $del_file){
                    $this->delete_file($del_file);
                }
            }
            if( $request->hasFile('upload_files')){
                $files = $request->file('upload_files');
                foreach ($files as $file){
                    $this->upload_file($file,$list->id);
                }
            }

            return redirect('/micro-course/result')->with('message','修改成功!');
        }else{
            return redirect('/micro-course/result')->with('message', '無此文章!');
        }
    }

    public function result_delete(Request $request,$id)
    {
        $list = Article::find($id);
        $list -> delete();
        return redirect('/micro-course/result')->with('message','刪除成功!');
    }
    #endregion

    #region 師生榮譽榜
    public function honor_index()
    {
        $lists =  Article::where('type',3)->get();
        return view('admin.honor.index',compact('lists'));
    }

    public function honor_create()
    {
        return view('admin.honor.create');
    }

    public function honor_store(Request $request)
    {
        $new_list = new Article();
        $new_list -> type = 3;
        $new_list -> plan_type = $request->plan_type;
        $new_list -> title = $request->title;
        $new_list -> content = $request-> main_content;
        $new_list -> date = $request-> date;
        $new_list -> save();
        return redirect('/micro-course/honor')->with('message','新增成功!');
    }

    public function honor_edit($id)
    {
        $list = Article::find($id);
        if($list->type == 3){
            return view('admin.honor.edit',compact('list'));
        }else {
            return redirect('/micro-course/honor')->with('message', '無此文章!');
        }
    }

    public function honor_update(Request $request,$id)
    {
        $list = Article::find($id);
        if($list->type == 3){
            $list->plan_type = $request->plan_type;
            $list -> title = $request->title;
            $list -> content = $request-> main_content;
            $list -> date = $request-> date;
            $list -> save();
            return redirect('/micro-course/honor')->with('message','修改成功!');
        }else{
            return redirect('/micro-course/honor')->with('message', '無此文章!');
        }
    }

    public function honor_delete(Request $request,$id)
    {
        $list = Article::find($id);
        $list -> delete();
        return redirect('/micro-course/honor')->with('message','刪除成功!');
    }
    #endregion

    #region 課程專區
    public function course_index()
    {
        $lists =  Article::whereIn('type',[9,10])->get();
        return view('admin.article_course.index',compact('lists'));
    }

    public function course_create()
    {
        return view('admin.article_course.create');
    }

    public function course_store(Request $request)
    {
        $new_list = new Article();
        $new_list -> type = $request->type;
        $new_list -> plan_type = $request->plan_type;
        $new_list -> title = $request->title;
        $new_list -> content = $request-> main_content;
        $new_list -> date = $request-> date;
        $new_list -> save();

        if( $request->hasFile('upload_files')){
            $files = $request->file('upload_files');
            $this->upload_file($files,$new_list->id);
        }

        return redirect('/micro-course/article_course')->with('message','新增成功!');
    }

    public function course_edit($id)
    {
        $list = Article::find($id);
        if($list->type == 9 || $list->type == 10){
            $files = DownloadFile::where('article_id',$id) -> get();
            return view('admin.article_course.edit',compact('list','files'));
        }else {
            return redirect('/micro-course/article_course')->with('message', '無此文章!');
        }
    }

    public function course_update(Request $request,$id)
    {
        $list = Article::find($id);
        if($list->type == 9 || $list->type == 10){
            $list->type = $request->type;
            $list->plan_type = $request->plan_type;
            $list -> title = $request->title;
            $list -> content = $request-> main_content;
            $list -> date = $request-> date;
            $list -> save();

            if( $request->hasFile('upload_files')){
                $files = DownloadFile::where('article_id',$id) -> get();
                foreach ($files as $del_file){
                    $this->delete_file($del_file->id);
                }

                $files = $request->file('upload_files');
                $this->upload_file($files,$list->id);
            }

            return redirect('/micro-course/article_course')->with('message','修改成功!');
        }else{
            return redirect('/micro-course/article_course')->with('message', '無此文章!');
        }
    }

    public function course_delete(Request $request,$id)
    {
        $list = Article::find($id);
        $list -> delete();
        return redirect('/micro-course/article_course')->with('message','刪除成功!');
    }
    #endregion

    #region 媒體頻道
    public function video_index()
    {
        $lists =  Article::where('type',4)->get();
        return view('admin.video.index',compact('lists'));
    }

    public function video_create()
    {
        return view('admin.video.create');
    }

    public function video_store(Request $request)
    {
        $new_list = new Article();
        $new_list -> type = 4;
        $new_list -> plan_type = $request->plan_type;
        $new_list -> title = $request->title;
        $new_list -> content = $request-> main_content;
        $new_list -> date = $request-> date;
        $new_list -> save();

        if( $request->hasFile('upload_files')){
            $files = $request->file('upload_files');
            $this->upload_file($files,$new_list->id);
        }

        return redirect('/micro-course/video')->with('message','新增成功!');
    }

    public function video_edit($id)
    {
        $list = Article::find($id);
        if($list->type == 4){
            $files = DownloadFile::where('article_id',$id) -> get();
            return view('admin.video.edit',compact('list','files'));
        }else {
            return redirect('/micro-course/video')->with('message', '無此文章!');
        }
    }

    public function video_update(Request $request,$id)
    {
        $list = Article::find($id);
        if($list->type == 4){
            $list->plan_type = $request->plan_type;
            $list -> title = $request->title;
            $list -> content = $request-> main_content;
            $list -> date = $request-> date;
            $list -> save();

            if( $request->hasFile('upload_files')){
                $files = DownloadFile::where('article_id',$id) -> get();
                foreach ($files as $del_file){
                    $this->delete_file($del_file->id);
                }

                $files = $request->file('upload_files');
                $this->upload_file($files,$list->id);
            }

            return redirect('/micro-course/video')->with('message','修改成功!');
        }else{
            return redirect('/micro-course/video')->with('message', '無此文章!');
        }
    }

    public function video_delete(Request $request,$id)
    {
        $list = Article::find($id);
        $list -> delete();
        return redirect('/micro-course/video')->with('message','刪除成功!');
    }
    #endregion

    #region 下載專區
    public function download_index()
    {
        $lists =  Article::where('type',5)->get();
        return view('admin.download.index',compact('lists'));
    }

    public function download_create()
    {
        return view('admin.download.create');
    }

    public function download_store(Request $request)
    {
        $new_list = new Article();
        $new_list -> type = 5;
        $new_list -> plan_type = $request->plan_type;
        $new_list -> title = $request->title;
        $new_list -> content = $request-> main_content;
        $new_list -> date = $request-> date;
        $new_list -> save();
        if( $request->hasFile('upload_files')){
           $files = $request->file('upload_files');
           foreach ($files as $file){
               $this->upload_file($file,$new_list->id);
           }
        }
        return redirect('/micro-course/download')->with('message','新增成功!');
    }

    public function download_edit($id)
    {
        $list = Article::find($id);
        if($list->type == 5){
            $files = DownloadFile::where('article_id',$id) -> get();
            return view('admin.download.edit',compact('list','files'));
        }else {
            return redirect('/micro-course/download')->with('message', '無此文章!');
        }
    }

    public function download_update(Request $request,$id)
    {
        $list = Article::find($id);
        if($list->type == 5){
            $list->plan_type = $request->plan_type;
            $list -> title = $request->title;
            $list -> content = $request-> main_content;
            $list -> date = $request-> date;
            $list -> save();
            if($request->del_files != null){
                $del_files = $request->del_files;
                foreach ($del_files as $del_file){
                   $this->delete_file($del_file);
                }
            }
            if( $request->hasFile('upload_files')){
                $files = $request->file('upload_files');
                foreach ($files as $file){
                    $this->upload_file($file,$list->id);
                }
            }
            return redirect('/micro-course/download')->with('message','修改成功!');
        }else{
            return redirect('/micro-course/download')->with('message', '無此文章!');
        }
    }

    public function download_delete(Request $request,$id)
    {
        $list = Article::find($id);
        $files = DownloadFile::where('article_id',$id)->get();
        foreach ($files as $file){
            $this->delete_file($file->id);
        }
        $list -> delete();
        return redirect('/micro-course/honor')->with('message','刪除成功!');
    }
    #endregion

    #region 特色亮點成果
    public function highlight_index()
    {
        $lists =  Article::where('type',6)->get();
        return view('admin.highlight.index',compact('lists'));
    }

    public function highlight_create()
    {
        return view('admin.highlight.create');
    }

    public function highlight_store(Request $request)
    {
        $new_list = new Article();
        $new_list -> type = 6;
        $new_list -> plan_type = $request->plan_type;
        $new_list -> title = $request->title;
        $new_list -> content = $request-> main_content;
        $new_list -> date = $request-> date;
        $new_list -> save();
        if( $request->hasFile('upload_files')){
            $files = $request->file('upload_files');
            foreach ($files as $file){
                $this->upload_file($file,$new_list->id);
            }
        }
        return redirect('/micro-course/highlight')->with('message','新增成功!');
    }

    public function highlight_edit($id)
    {
        $list = Article::find($id);
        if($list->type == 6){
            $files = DownloadFile::where('article_id',$id) -> get();
            return view('admin.highlight.edit',compact('list','files'));
        }else {
            return redirect('/micro-course/highlight')->with('message', '無此文章!');
        }
    }

    public function highlight_update(Request $request,$id)
    {
        $list = Article::find($id);
        if($list->type == 6){
            $list->plan_type = $request->plan_type;
            $list -> title = $request->title;
            $list -> content = $request-> main_content;
            $list -> date = $request-> date;
            $list -> save();
            if($request->del_files != null){
                $del_files = $request->del_files;
                foreach ($del_files as $del_file){
                    $this->delete_file($del_file);
                }
            }
            if( $request->hasFile('upload_files')){
                $files = $request->file('upload_files');
                foreach ($files as $file){
                    $this->upload_file($file,$list->id);
                }
            }
            return redirect('/micro-course/highlight')->with('message','修改成功!');
        }else{
            return redirect('/micro-course/highlight')->with('message', '無此文章!');
        }
    }

    public function highlight_delete(Request $request,$id)
    {
        $list = Article::find($id);
        $files = DownloadFile::where('article_id',$id)->get();
        foreach ($files as $file){
            $this->delete_file($file->id);
        }
        $list -> delete();
        return redirect('/micro-course/highlight')->with('message','刪除成功!');
    }
    #endregion

    #region 其他
    public function other_index()
    {
        $lists =  Article::where('type',7)->get();
        return view('admin.other.index',compact('lists'));
    }

    public function other_create()
    {
        return view('admin.other.create');
    }

    public function other_store(Request $request)
    {
        $new_list = new Article();
        $new_list -> type = 7;
        $new_list -> plan_type = $request->plan_type;
        $new_list -> title = $request->title;
        $new_list -> content = $request-> main_content;
        $new_list -> date = $request-> date;
        $new_list -> save();
        if( $request->hasFile('upload_files')){
            $files = $request->file('upload_files');
            foreach ($files as $file){
                $this->upload_file($file,$new_list->id);
            }
        }
        return redirect('/micro-course/other')->with('message','新增成功!');
    }

    public function other_edit($id)
    {
        $list = Article::find($id);
        if($list->type == 7){
            $files = DownloadFile::where('article_id',$id) -> get();
            return view('admin.other.edit',compact('list','files'));
        }else {
            return redirect('/micro-course/other')->with('message', '無此文章!');
        }
    }

    public function other_update(Request $request,$id)
    {
        $list = Article::find($id);
        if($list->type == 7){
            $list->plan_type = $request->plan_type;
            $list -> title = $request->title;
            $list -> content = $request-> main_content;
            $list -> date = $request-> date;
            $list -> save();
            if($request->del_files != null){
                $del_files = $request->del_files;
                foreach ($del_files as $del_file){
                    $this->delete_file($del_file);
                }
            }
            if( $request->hasFile('upload_files')){
                $files = $request->file('upload_files');
                foreach ($files as $file){
                    $this->upload_file($file,$list->id);
                }
            }
            return redirect('/micro-course/other')->with('message','修改成功!');
        }else{
            return redirect('/micro-course/other')->with('message', '無此文章!');
        }
    }

    public function other_delete(Request $request,$id)
    {
        $list = Article::find($id);
        $files = DownloadFile::where('article_id',$id)->get();
        foreach ($files as $file){
            $this->delete_file($file->id);
        }
        $list -> delete();
        return redirect('/micro-course/other')->with('message','刪除成功!');
    }
    #endregion

    #region 宣傳品
    public function promote_index()
    {
        $lists =  Article::where('type',8)->get();
        return view('admin.promote.index',compact('lists'));
    }

    public function promote_create()
    {
        return view('admin.promote.create');
    }

    public function promote_store(Request $request)
    {
        $new_list = new Article();
        $new_list -> type = 8;
        $new_list -> plan_type = $request->plan_type;
        $new_list -> title = $request->title;
        $new_list -> content = $request-> main_content;
        $new_list -> date = $request-> date;
        $new_list -> save();
        if( $request->hasFile('upload_files')){
            $files = $request->file('upload_files');
            foreach ($files as $file){
                $this->upload_file($file,$new_list->id);
            }
        }
        return redirect('/micro-course/promote')->with('message','新增成功!');
    }

    public function promote_edit($id)
    {
        $list = Article::find($id);
        if($list->type == 8){
            $files = DownloadFile::where('article_id',$id) -> get();
            return view('admin.promote.edit',compact('list','files'));
        }else {
            return redirect('/micro-course/promote')->with('message', '無此文章!');
        }
    }

    public function promote_update(Request $request,$id)
    {
        $list = Article::find($id);
        if($list->type == 8){
            $list->plan_type = $request->plan_type;
            $list -> title = $request->title;
            $list -> content = $request-> main_content;
            $list -> date = $request-> date;
            $list -> save();
            if($request->del_files != null){
                $del_files = $request->del_files;
                foreach ($del_files as $del_file){
                    $this->delete_file($del_file);
                }
            }
            if( $request->hasFile('upload_files')){
                $files = $request->file('upload_files');
                foreach ($files as $file){
                    $this->upload_file($file,$list->id);
                }
            }
            return redirect('/micro-course/promote')->with('message','修改成功!');
        }else{
            return redirect('/micro-course/promote')->with('message', '無此文章!');
        }
    }

    public function promote_delete(Request $request,$id)
    {
        $list = Article::find($id);
        $files = DownloadFile::where('article_id',$id)->get();
        foreach ($files as $file){
            $this->delete_file($file->id);
        }
        $list -> delete();
        return redirect('/micro-course/promote')->with('message','刪除成功!');
    }
    #endregion

    #region USR計畫
    public function plan_page_index($id){
        if($id > 0 && $id <7){
            $page = PlanPage::find($id);
            return view('admin.plan_page.index',compact('page'));
        }else{
            return redirect('/micro-course')->with('message', '無此文章!');
        }
    }

    public function plan_page_edit($id){
        if($id > 0 && $id <6){
        $page = PlanPage::find($id);
        return view('admin.plan_page.edit',compact('page'));
        }else{
            return redirect('/micro-course')->with('message', '無此文章!');
        }
    }

    public function plan_page_update(Request $request,$id){
        $list = PlanPage::find($id);
        $list -> content = $request-> main_content;
        $list -> save();
        return redirect('/micro-course/plan_page/'.$id)->with('message','修改成功!');
    }

    public function plan_article_index()
    {
        $lists = PlanArticle::with('download_files')->get();
        return view('admin.plan_page.page_article.index',compact('lists'));
    }

    public function plan_article_create(){
        return view('admin.plan_page.page_article.create');
    }

    public function plan_article_store(Request $request){
        $new_list = new PlanArticle();
        $new_list -> title = $request->title;
        $new_list -> save();
        if( $request->hasFile('upload_files')){
            $files = $request->file('upload_files');
            foreach ($files as $file){
                $this->plan_upload_file($file,$new_list->id);
            }
        }
        return redirect('/micro-course/plan_page_related_legislation')->with('message','新增成功!');
    }

    public function plan_article_edit($id){
        $list = PlanArticle::with('download_files')->find($id);
        return view('admin.plan_page.page_article.edit',compact('list'));
    }

    public function plan_article_update(Request $request,$id){
        $list = PlanArticle::find($id);
        $list -> title = $request->title;
        $list -> content = $request-> main_content;
        $list -> save();
        if($request->del_files != null){
            $del_files = $request->del_files;
            foreach ($del_files as $del_file){
                $this->delete_file($del_file);
            }
        }
        if( $request->hasFile('upload_files')){
            $files = $request->file('upload_files');
            foreach ($files as $file){
                $this->plan_upload_file($file,$list->id);
            }
        }
        return redirect('/micro-course/plan_page_related_legislation')->with('message','修改成功!');

    }

    public function plan_article_delete(Request $request,$id){
        $list = PlanArticle::find($id);
        $files = DownloadFile::where('plan_id',$id)->get();
        foreach ($files as $file){
            $this->delete_file($file->id);
        }
        $list -> delete();
        return redirect('/micro-course/plan_page_related_legislation')->with('message','刪除成功!');
    }
    #endregion



    //上傳檔案
    public function upload_file($file,$id){
        $allowed_extensions = ["png", "jpg", "gif", "PNG", "JPG", "GIF","doc","docx","xls"."xlsx","pdf",'DOC',"DOCX","XLS","XLSX","PDF"];
        if ($file->getClientOriginalExtension() &&
            !in_array($file->getClientOriginalExtension(), $allowed_extensions))
        {
            return redirect()->back()->with('message','僅接受jpg, png, gif, doc, docx, xls, xlsx, pdf格式檔案!');
        }
        $extension = $file->getClientOriginalExtension();
        $destinationPath = public_path() . '/download/';
        $original_filename = $file->getClientOriginalName();

        $filename = $file->getFilename() . '.' . $extension;
        $url = '/download/' . $filename;

        $file->move($destinationPath, $filename);

        $value = new DownloadFile();
        $value -> article_id = $id;
        $value -> old_filename = $original_filename;
        $value -> ext = $extension;
        $value -> url = $url;
        $value-> save();
    }

    //USR計畫-上傳檔案
    public function plan_upload_file($file,$id){
        $allowed_extensions = ["png", "jpg", "gif", "PNG", "JPG", "GIF","doc","docx","xls"."xlsx","pdf",'DOC',"DOCX","XLS","XLSX","PDF"];
        if ($file->getClientOriginalExtension() &&
            !in_array($file->getClientOriginalExtension(), $allowed_extensions))
        {
            return redirect()->back()->with('message','僅接受jpg, png, gif, doc, docx, xls, xlsx, pdf格式檔案!');
        }
        $extension = $file->getClientOriginalExtension();
        $destinationPath = public_path() . '/download/';
        $original_filename = $file->getClientOriginalName();

        $filename = $file->getFilename() . '.' . $extension;
        $url = '/download/' . $filename;

        $file->move($destinationPath, $filename);

        $value = new DownloadFile();
        $value -> plan_id = $id;
        $value -> old_filename = $original_filename;
        $value -> ext = $extension;
        $value -> url = $url;
        $value-> save();
    }

    //刪除檔案
    public function delete_file($file_id){
        $file = DownloadFile::find($file_id);
        File::delete(public_path().$file->url);
        $file->delete();
    }

    //文章置頂
    public function to_top(Request $request, $top, $id){
        $article = Article::find($id);
        if($top == 'top')
        {
            $article -> top = 1;
            $article -> save();
            return redirect()->back();
        }
        else if($top == 'normal'){
            $article -> top = 0;
            $article -> save();
            return redirect()->back();
        }else {
            return redirect('/');
        }
    }
}
