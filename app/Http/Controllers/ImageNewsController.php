<?php

namespace App\Http\Controllers;
use App\ImageNews;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ImageNewsController extends Controller
{
    #region 活動圖片
    public function activity_index()
    {
        $lists =  ImageNews::where('type',1)->get();
        return view('admin.activity.index',compact('lists'));
    }

    public function activity_create()
    {
        return view('admin.activity.create');
    }

    public function activity_store(Request $request)
    {
        $new_list = new ImageNews();
        $new_list -> type = 1;
        $new_list -> link = $request->link;
        $new_list -> sort = $request->sort;
        $new_list -> image_url = $this->upload_file($request-> file('upload_file'),"activity");
        $new_list -> save();
        return redirect('/micro-course/activity')->with('message','新增成功!');
    }

    public function activity_edit($id)
    {
        $list = ImageNews::find($id);
        if($list->type == 1){
            return view('admin.activity.edit',compact('list'));
        }else {
            return redirect('/micro-course/activity')->with('message', '無此相片!');
        }
    }

    public function activity_update(Request $request,$id)
    {
        $list = ImageNews::find($id);
        if($list->type == 1){
            $list -> link = $request->link;
            $list -> sort = $request->sort;
            if($request-> hasFile('upload_file')){
                File::delete(public_path(). $list -> image_url);
                $list -> image_url = $this->upload_file($request-> file('upload_file'),"activity");
            }
            $list -> save();
            return redirect('/micro-course/activity')->with('message','修改成功!');
        }else{
            return redirect('/micro-course/activity')->with('message', '無此相片!');
        }
    }

    public function activity_delete(Request $request,$id)
    {
        $list = ImageNews::find($id);
        File::delete(public_path(). $list -> image_url);
        $list -> delete();
        return redirect('/micro-course/activity')->with('message','刪除成功!');
    }
    #endregion

    #region 重要公告
    public function important_index()
    {
        $lists =  ImageNews::where('type',2)->get();
        foreach ($lists as $list){
            $list -> image_url = json_decode($list -> image_url,true);
        }
        return view('admin.important.index',compact('lists'));
    }

    public function important_create()
    {
        return view('admin.important.create');
    }

    public function important_store(Request $request)
    {
        $new_list = new ImageNews();
        $new_list -> type = 2;
        $new_list -> link = $request->link;
        $new_list -> sort = $request->sort;
        if($request->hasFile('upload_file')){
            $urls = array();
            $i = 1;
            foreach ($request->file('upload_file') as $file){
                $url_info = array('id'=>$i,'url'=>$this->upload_file($file,"important"));
                array_push($urls,$url_info);
                $i++;
            }
            $new_list -> image_url = json_encode($urls);
        }
        $new_list -> save();
        return redirect('/micro-course/important')->with('message','新增成功!');
    }

    public function important_edit($id)
    {
        $list = ImageNews::find($id);
        if($list->type == 2){
            $list-> image_url = json_decode($list-> image_url,true);
            return view('admin.important.edit',compact('list'));
        }else {
            return redirect('/micro-course/important')->with('message', '無此文章!');
        }
    }

    public function important_update(Request $request,$id)
    {
        $list = ImageNews::find($id);
        if($list->type == 2){
            $list -> link = $request->link;
            $list -> sort = $request->sort;
            $urls = array();
            $i = 1;
            $image_urls =  json_decode($list -> image_url,true);
            foreach ($image_urls as $url){
                if($request->delete_img != null){
                    if(in_array($url["id"],$request->delete_img)){
                        File::delete(public_path().$url["url"]);
                    }
                    else{
                        $url["id"] = $i;
                        array_push($urls,$url);
                        $i++;
                    }
                }
                else{
                    $url["id"] = $i;
                    array_push($urls,$url);
                    $i++;
                }

            }
            if($request-> hasFile('upload_file')){
                foreach ($request->file('upload_file') as $file){
                    $url_info = array('id'=>$i,'url'=>$this->upload_file($file,"important"));
                    array_push($urls,$url_info);
                    $i++;
                }
            }
            $list->image_url = json_encode($urls);
            $list -> save();
            return redirect('/micro-course/important')->with('message','修改成功!');
        }
        else{
            return redirect('/micro-course/important')->with('message', '無此文章!');
        }
    }

    public function important_delete(Request $request,$id)
    {
        $list = ImageNews::find($id);
        $list -> image_url = json_decode($list -> image_url,true);
        foreach ($list -> image_url as $url){
            File::delete(public_path(). $url['url']);
        }
        $list -> delete();
        return redirect('/micro-course/important')->with('message','刪除成功!');
    }
    #endregion

    //圖片上傳
    public function upload_file($file,$path){
        $path = '/'.$path.'/';
        $allowed_extensions = ["png", "jpg", "gif", "PNG", "JPG", "GIF"];
        if ($file->getClientOriginalExtension() &&
            !in_array($file->getClientOriginalExtension(), $allowed_extensions))
        {
            return redirect()->back()->with('message','僅接受jpg, png, gif, doc, docx, xls, xlsx, pdf格式檔案!');
        }
        $extension = $file->getClientOriginalExtension();
        $destinationPath = public_path() . $path;
        $original_filename = $file->getClientOriginalName();

        $filename = $file->getFilename() . '.' . $extension;
        $url = $path . $filename;

        $file->move($destinationPath, $filename);

        return $url;
    }
}
