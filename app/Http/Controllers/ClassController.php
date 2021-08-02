<?php

namespace App\Http\Controllers;

use App\SignUp;
use App\Courses;
use App\Tutorials;
use App\RollCallQR;
use App\ClassAnnounces;
use App\RollCallRecords;
use Illuminate\Http\Request;
use App\Mail\NewCourseToAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ClassController extends Controller
{
    public function index()
    {
        $feature_name = '單元管理';
        $items = Courses::whereIn('status', ['待審核','已通過','已開課','已結束','未送出'])
                        ->orderBy('id','desc')
                        ->get();

        return view('admin.class.index',compact('items','feature_name'));
    }

    public function create()
    {
        $tutorials = Tutorials::getAll()->get();
        return view('admin.class.create', compact('tutorials'));
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
        $feature_name = '單元管理';
        $item = Courses::find($id);
        return view('admin.class.check',compact('item','feature_name'));
    }

    public function edit($id)
    {
        $feature_name = '單元管理';
        $item = Courses::find($id);
        $tutorials = Tutorials::getAll()->get();
        return view('admin.class.edit',compact('item','tutorials','feature_name'));
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
            Mail::to('admin@gmail.com')->queue(new NewCourseToAdmin());

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
        $items = ClassAnnounces::getAllAnnounce($id)->get();
        return view('admin.class.announce_index',compact('items','class'));
    }

    public function announce_create($id)
    {
        return view('admin.class.announce_create',compact('id'));
    }

    // public function announce_edit($id)
    // {
    //     return view('admin.class.announce_edit',compact('id'));
    // }

    public function announce_store(Request $request)
    {
        $new_record = ClassAnnounces::create($request->all());

        if($request->hasFile('files')){
            $new_record->fill(['files' => $this->upload_file($request->file('files'))]);
        }

        $new_record->save();
        
        // 儲存後 抓取已報名學生的名單 透過關聯找出他們的信箱進行寄信(先寫foreach 之後改queue)
        

        return redirect()->back()->with('success','公告新增成功');
    }
    
    public function announce_delete($id)
    {
        $item = ClassAnnounces::find($id);
        $item->soft_delete = 1;
        $item->save();

        return redirect()->back();
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
        $course = Courses::find($id);
        $items = SignUp::where('course_id',$id)->get();
        return view('admin.class.check_students',compact('course','items'));
    }

    public function rollCall($id)
    {
        return view('admin.class.roll_call',compact('id'));
    }

    public function QRCode_generate(Request $request,$id)
    {
        $roll_call = RollCallRecords::create([
            'course_id'=> $id,
            'students_id'=> '[]',
            'date'=> date("Y-m-d h:i", time()),
            'time'=> $request->time,
        ]);

        return redirect('/admin/class/roll_call_online/'.$id);
    }

    public function roll_call_online($id)
    {
        $date = strtotime(date('m/d/Y h:i:s a', time()));

        $records = RollCallRecords::where('course_id',$id)->get();
        
        return view('admin.class.generate',compact('records','id'));
    }

    public function rollCall_records($id)
    {
        return view('admin.class.roll_call_records');
    }

    public function rollCall_records_check($id)
    {
        $record = RollCallRecords::find($id);
        $items = SignUp::GetStudentList($record->course_id)->get();

        return view('admin.class.roll_call_records_check',compact('items','record'));
    }

    public function student_roll_call($id)
    {
        // 透過QRcode附在網址上的ID找到當前開放點名的紀錄X
        // 再檢測透過網址進來的使用者是否有報名此課程(沒報名則導向至其他頁)X
        // 驗證此使用者是否重複點名(有重複點名則導向至其他頁)
        // 完成點名(導向至其他頁)X
        $user = Auth::user();
        $roll_call_record = RollCallRecords::find($id);
        $list = SignUp::CheckStudentList($roll_call_record->course_id);

        // 檢查是否有報名
        if(!in_array($user->id,$list)){
            return redirect('/admin/qrcode/rollcall_status')->with('status_msg', '您並未報名此課程!');
        }

        // 檢查是否有重複點名
        if(!in_array($user->id, json_decode($roll_call_record->students_id))){

            $new_list = array_push($user->id,json_decode($roll_call_record->students_id));
            $roll_call_record->students_id = json_encode($new_list);
            $roll_call_record->save();

            return redirect('/admin/qrcode/rollcall_status')->with('status_msg','您已成功點名!');
        }elseif(in_array($user->id, json_decode($roll_call_record->students_id))){
            return redirect('/admin/qrcode/rollcall_status')->with('status_msg','您已重複點名!');
        }

    }

    public function student_roll_call_status()
    {
        if(Session::get('status_msg'))
            return view('admin.course.student.qr_code.signup_status');
        else
            return redirect('/admin/dashboard');
    }

    public function qrcode_status()
    {
        return view('admin.course.student.qr_code.signup_status');
    }

    public function review()
    {
        $feature_name = '單元審核';
        $items = Courses::whereIn('status', ['待審核','未送出'])
                        ->orderBy('id','desc')
                        ->get();
        return view('admin.class.index',compact('items','feature_name'));
    }

    public function review_check($id)
    {
        $feature_name = '單元審核';
        $item = Courses::find($id);
        return view('admin.class.check',compact('item','feature_name'));
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
        $feature_name = '已撤下單元';
        $items = Courses::whereIn('status', ['已撤下','審核未通過'])
                        ->orderBy('id','desc')
                        ->get();

        return view('admin.class.index',compact('items','feature_name'));
    }

    public function fail_check($id)
    {
        $feature_name = '已撤下單元';
        $item = Courses::find($id);
        return view('admin.class.check',compact('item','feature_name'));
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

    public function sign_up($id)
    {
        // 報名前先注意是否額滿 若額滿則回full
        $signup_number = count(SignUp::where('course_id',$id)->get());
        $course = Courses::find($id);

        if($signup_number >= $course->number) {
            return redirect()->back()->with('signup_full','');
        }

        // 沒額滿開始建立報名

        $user = Auth::user();
        SignUp::create([
            'course_id'=> $id,
            'student_id'=> $user->id,
            'student_name'=> $user->name
        ]);

        return redirect()->back()->with('signup_success');
    }

    public function remove_sign_up($id)
    {
        $user = Auth::user()->id;
        $record = Signup::where('course_id',$id)->where('student_id',$user)->first();
        $record->delete();

        return redirect()->back()->with('delete_success','');
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
