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
        $academic_years = $this->get_academic_year();

        return view('admin.class.create', compact('tutorials','academic_years'));
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

    public function get_academic_year()
    {
        $year = date("Y") - 1911;
        $current_year = $year - 1;
        $next_year = $year;
        $previous_year = $year - 2;
        $years = [$next_year, $next_year, $current_year, $current_year, $previous_year, $previous_year];

        return $years;
    }

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

    public function assessment_store(Request $request,$id)
    {
        // 送入通過的學號陣列 用has_key去尋找該學號是否在通過的學號陣列中 有就改尚未評分變成通過 沒有則改成未通過
        $passed_array = $request->assessment;

        $student_list = Courses::find($id)->signupList;

        foreach($student_list as $student){
            if(in_array($student->student_id, $passed_array)){
                $student->pass = '通過';
                $student->save();
            }else if(!in_array($student->student_id, $passed_array)){
                $student->pass = '未通過';
                $student->save();
            }
        }

        if(Auth::user()->role == 'admin')
            return redirect('/admin/class')->with('passed','期末課程評分已完成!');
        elseif(Auth::user()->role == 'teacher')
            return redirect('/admin/teacher/class')->with('passed','期末課程評分已完成!');

    }

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

    public function rollCall_records_edit($id)
    {
        $record = RollCallRecords::find($id);
        $items = SignUp::GetStudentList($record->course_id)->get();

        return view('admin.class.roll_call_records_edit',compact('items','record'));
    }

    public function rollCall_records_update(Request $request,$id)
    {
        // 取得點名中的資料
        $record = RollCallRecords::find($id);

        // 取得學生清單
        $list = SignUp::CheckStudentList($record->course_id);
        
        // 送入的有到學生名單
        $roll_call_array = $request->roll_call;

        // 用foreach去把學生清單的每筆資料和剛送入的學生名單陣列做比較 若此筆資料有出現則將取得的點名資料push當前的學號
        foreach($list as $student){
            if(in_array($student,$roll_call_array)){
                $record_list = json_decode($record->students_id);
                array_push($record_list,$student);
                $record->students_id = json_encode($record_list);
                $record->save();

            }
        }

        return redirect('/admin/class/roll_call_online/'.$record->course_id)->with('success','編輯成功!');
    }

    public function student_roll_call($id)
    {
        $user_id = Auth::user()->account_id;
        $roll_call_record = RollCallRecords::find($id);
        $list = SignUp::CheckStudentList($roll_call_record->course_id);

        // 檢查是否有報名
        if(!in_array($user_id,$list)){
            return redirect('/admin/qrcode/rollcall_status')->with('status_msg', '您並未報名此課程!');
        }

        // 檢查是否有重複點名
        if(!in_array($user_id, json_decode($roll_call_record->students_id))){
            $list = json_decode($roll_call_record->students_id);
            array_push($list,$user_id);
            $roll_call_record->students_id = json_encode($list);
            $roll_call_record->save();

            return redirect('/admin/qrcode/rollcall_status')->with('status_msg','您已成功點名!');
        }elseif(in_array($user_id, json_decode($roll_call_record->students_id))){
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
            'student_id'=> $user->account_id,
            'student_name'=> $user->name,
            'academic_year'=> $course->academic_year
        ]);

        return redirect()->back()->with('signup_success');
    }

    public function remove_sign_up($id)
    {
        $user = Auth::user()->account_id;
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
