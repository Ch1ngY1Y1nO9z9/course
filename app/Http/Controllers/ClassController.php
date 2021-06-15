<?php

namespace App\Http\Controllers;

use App\Courses;
use App\ClassAnnounces;
use Illuminate\Http\Request;
use App\Mail\NewCourseToAdmin;
use App\RollCallQR;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ClassController extends Controller
{
    public function index()
    {
        $items = Courses::where('status','!=','已撤下')->where('status','!=','審核未通過')->orderBy('id','desc')->get();
        return view('admin.class.index',compact('items'));
    }

    public function create()
    {
        return view('admin.class.create');
    }


    public function store(Request $request)
    {
        $new_record = Courses::create($request->all());

        if($request->hasFile('files')){
            $new_record->fill(['files' => $this->upload_file($request->file('files'))]);
        }

        $new_record->save();

        $role = Auth::user()->role;

        if($role == 'admin')
            return redirect('/admin/class');
        elseif($role == 'teacher')
            Mail::to('admin@gmail.com')->send(new NewCourseToAdmin());
            return redirect('/admin/teacher/class');
    }


    public function check($id)
    {
        $item = Courses::find($id);
        return view('admin.class.check',compact('item'));
    }

    public function edit($id)
    {
        $item = Courses::find($id);
        return view('admin.class.edit',compact('item'));
    }

    public function update(Request $request,$id)
    {
        $item = Courses::find($id);
        $item->update($request->all());

        if($request->hasFile('files')){
            $this->delete_file($item->files);
            $item->files = $this->upload_file($request->file('files'));
        }

        if($item->status == '未送出')
            $item->status = '待審核';
            Mail::to('admin@gmail.com')->send(new NewCourseToAdmin());

        $item->save();

        $role = Auth::user()->role;

        if($role == 'admin')
            return redirect('/admin/class');
        elseif($role == 'teacher')
            return redirect('/admin/teacher/class');
    }

    public function delete(Request $request,$id)
    {
        $item = Courses::find($id);
        $item->status = '已撤下';
        $item->save();

        $role = Auth::user()->role;

        if($role == 'admin')
            return redirect('/admin/class');
        elseif($role == 'teacher')
            return redirect('/admin/teacher/class');
    }

    public function copy(Request $request,$id)
    {
        $item = Courses::find($id);
        $new_record = $item->replicate();
        $new_record->status = '未送出';
        $new_record->files = null;
        $new_record->remarks = null;
        $new_record->created_at = date('Y-m-d h:i:s', time());
        $new_record->save();

        return redirect()->back()->with('copy_success','複製完成!');
    }

    public function announce($id)
    {
        $class = Courses::find($id);
        $items = ClassAnnounces::all();
        return view('admin.class.announce_index',compact('items','class'));
    }

    public function announce_create($id)
    {
        return view('admin.class.announce_create',compact('id'));
    }

    public function announce_edit($id)
    {
        return view('admin.class.announce_edit',compact('id'));
    }

    public function assessment($id)
    {
        $class = Courses::find($id);
        return view('admin.class.assessment',compact('class'));
    }

    // public function assessment_store(Request $request,$id)
    // {
    //     // 數字藏在hidden input中送進來 建立一筆學生姓名+學生ID+是否通過 外鍵為課程ID
    //     if($id != $request->class_id)
    //         return redirect()->back();
        
    //     $new_record = ClassAnnounces::create($request->all());

    //     if($request->hasFile('files')){
    //         $new_record->fill(['files' => $this->upload_file($request->file('files'))]);
    //     }

    //     $new_record->save();

    //     $role = Auth::user()->role;

    //     if($role == 'admin')
    //         return redirect('/admin/class');
    //     elseif($role == 'teacher')
    //         Mail::to('admin@gmail.com')->send(new NewCourseToAdmin());
    //         return redirect('/admin/teacher/class');
        
    //     return view('admin.class.check',compact('item'));
    // }



    
    public function check_students($id)
    {
        return view('admin.class.check_students');
    }

    public function rollCall($id)
    {
        return view('admin.class.roll_call',compact('id'));
    }

    public function QRCode_generate(Request $request,$id)
    {
        $class = Courses::find($id);
        $file_name = 'qrcodes/'.$class->class_en.'_'.$request->time.'.png';
        QrCode::format('png')->size(150)->generate('Hello,World!',public_path($file_name));

        $new_record = RollCallQR::create($request->all());
        $new_record->qrcode_path = '/'.$file_name;
        $new_record->save();

        return redirect('/admin/class/roll_call_online')->with('qrcode_id', $new_record->id);
    }

    public function roll_call_online()
    {
        $id = Session::get('qrcode_id');
        $qrcode = RollCallQR::find($id);
        $class = Courses::find($qrcode->class_id);
        
        return view('admin.class.generate',compact('qrcode','class','id'));
    }


    public function rollCall_records($id)
    {
        return view('admin.class.roll_call_records');
    }

    public function rollCall_records_check($id)
    {
        return view('admin.class.roll_call_records_check');
    }

    public function review()
    {
        $items = Courses::where('status','待審核')->orderBy('id','desc')->get();
        return view('admin.class_review.index',compact('items'));
    }

    public function review_check($id)
    {
        $item = Courses::find($id);
        return view('admin.class_review.check',compact('item'));
    }

    public function review_result($id,$resule)
    {
        if(Auth::user()->role != 'admin')
            return redirect()->back();

        $item = Courses::find($id);
        if($resule == 'pass'){
            $item->status = '已通過';
        }elseif($resule == 'fail'){
            $item->status = '審核未通過';
        }
        $item->save();

        return redirect('/admin/class_review');
    }

    public function fail()
    {
        $items = Courses::where('status','!=','已通過')->where('status','!=','未送出')->where('status','!=','待審核')->orderBy('id','desc')->get();
        return view('admin.class_fail.index',compact('items'));
    }

    public function fail_check($id)
    {
        $item = Courses::find($id);
        return view('admin.class_fail.check',compact('item'));
    }

    public function delete_class($id)
    {
        $items = Courses::find($id);

        if($items->files){
            $this->delete_file($items->files);
        }

        $items->delete();

        return redirect()->back();
    }

    //上傳檔案
    public function upload_file($file){
        $extension = $file->getClientOriginalExtension();
        $destinationPath = public_path() . '/upload/courses/';
        $original_filename = $file->getClientOriginalName();

        $filename = $file->getFilename() . '.' . $extension;
        $url = '/upload/courses/' . $filename;

        $file->move($destinationPath, $filename);

        return $url;
    }

    //刪除檔案
    public function delete_file($path){
        File::delete(public_path().$path);
    }
}
