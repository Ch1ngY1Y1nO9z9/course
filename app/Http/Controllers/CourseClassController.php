<?php

namespace App\Http\Controllers;

use App\SignUp;
use App\Courses;
use App\ClassAnnounces;
use Illuminate\Http\Request;
use App\Jobs\CheckAnnounceStatus;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class CourseClassController extends Controller
{
    public function testqueue()
    {
    }

    public function index()
    {
        $items = SignUp::getRecords();

        return view('admin.course.index', compact('items'));
    }

    public function detail($id)
    {
        $items = SignUp::where('student_id', $id)->get();

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

        $year = $request->year;
        $academic = $request->academic;
        $academic_year = $year . $academic;

        // 先做錯誤判斷 若沒有該學年度資料則返回並報錯
        if(!SignUp::where('academic_year', $academic_year)->first()){
            return redirect()->back()->with('error','未查詢到資料!');
        }elseif(!SignUp::where('academic_year', $academic_year)->where('student_id', $request->student_id)->first()){
            return redirect()->back()->with('error','未查詢到資料!');
        }

        if (!$request->student_id) {
            // 尋找本年度有報名過課程的學生
            $items = SignUp::where('academic_year', $academic_year)->where('pass', '通過')->get()->unique('student_id');
        }else{
            $items = SignUp::where('academic_year', $academic_year)->where('student_id', $request->student_id)->get()->unique('student_id');
        }

        return view('admin.course.query',compact('items','year','academic'));
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
