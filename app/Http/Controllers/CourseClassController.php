<?php

namespace App\Http\Controllers;

use App\SignUp;
use App\Courses;
use App\ClassAnnounces;
use Illuminate\Http\Request;
use App\Jobs\CheckCoursesStatus;
use App\Jobs\CheckAnnounceStatus;
use App\Mail\Testmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class CourseClassController extends Controller
{
    public function annocunce()
    {
        dispatch(new CheckAnnounceStatus());
    }

    public function checkClassStatus()
    {
        dispatch(new CheckCoursesStatus());
    }


    public function index()
    {
        $items = SignUp::getRecords();

        return view('admin.course.index', compact('items'));
    }

    public function detail($id)
    {
        $items = SignUp::where('student_id', $id)->where('pass','通過')->get();

        return view('admin.course.student_detail', compact('items'));
    }

    public function class_detail($class_id)
    {
        $item = Courses::find($class_id);
        return view('admin.course.class_detail', compact('item'));
    }

    public function export()
    {
        $academics = SignUp::all()->unique('academic_year');

        return view('admin.course.export',compact('academics'));
    }

    public function export_query(Request $request)
    {
        // 組成搜尋條件(學年+學期)
        // 確認是否有指定學號
        // 若無->取得這些課程的學生名單(unique) 最後再依照學生名單做foreach給時數加總
        // 若有->取得指定學生再指定學年有報名過的課程 先進行判斷比對過濾沒通過的部分再進行foreach加總

        $academic = $request->academic;

        $ary = explode('-', $academic);
        if($ary[1] == '1'){
            $year = $ary[0].'上學期';
        }elseif($ary[1] == '2'){
            $year = $ary[0].'下學期';
        }

        // 先做錯誤判斷 若沒有該學年度資料則返回並報錯
        if($request->student_id){
            if(SignUp::where('academic_year', $academic)->where('student_id', $request->student_id)->count() == 0){
                return redirect()->back()->with('error','未查詢到資料!');
            }
        }else{
            if(SignUp::where('academic_year', $academic)->count() == 0){
                return redirect()->back()->with('error','未查詢到資料!');
            }
        }


        if (!$request->student_id) {
            // 尋找本年度有報名過課程的學生
            $items = SignUp::where('academic_year', $academic)->where('pass', '通過')->get()->unique('student_id');
        }else{
            $items = SignUp::where('academic_year', $academic)->where('student_id', $request->student_id)->get()->unique('student_id');
        }

        return view('admin.course.query',compact('items','year'));
    }

    public function export_to_excel(Request $request)
    {
        // 組成搜尋條件(學年+學期)
        // 確認是否有指定學號
        // 若無->取得這些課程的學生名單(unique) 最後再依照學生名單做foreach給時數加總
        // 若有->取得指定學生再指定學年有報名過的課程 先進行判斷比對過濾沒通過的部分再進行foreach加總

        $academic_year = $request->year . $request->academic;

        if (!$request->student_id) {
            $student_list = SignUp::where('academic_year', $academic_year)->get()->unique('student_id');
        }

        return redirect()->back();
    }


    public function student_index()
    {
        $user = Auth::user();
        $items = Courses::StudentSignUp()->get();
        $date = strtotime(date('m/d/Y h:i:s a', time()));
        return view('admin.course.student.index', compact('items', 'date', 'user'));
    }

    public function student_check($id)
    {
        $item = Courses::find($id);
        return view('admin.course.student.check', compact('item'));
    }

    public function records_index()
    {
        $user = Auth::user();
        $items = SignUp::where('student_id', $user->account_id)
            ->where('status','正取')
            ->orderby('created_at', 'desc')
            ->get();

        return view('admin.course.student.records.index', compact('items'));
    }

    public function records_check($id)
    {
        $item = Courses::find($id);
        return view('admin.course.student.check', compact('item'));
    }

    public function announce($id)
    {
        $items = ClassAnnounces::getPushedAnnounce($id)
            ->get();
        $date = strtotime(date('m/d/Y h:i:s a', time()));

        return view('admin.course.student.records.announce', compact('items', 'date'));
    }

    public function announce_check($id)
    {
        $item = ClassAnnounces::find($id);

        return view('admin.course.student.records.announce_check', compact('item'));
    }
}
