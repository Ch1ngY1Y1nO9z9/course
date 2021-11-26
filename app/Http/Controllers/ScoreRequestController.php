<?php

namespace App\Http\Controllers;

use App\SignUp;
use App\ScoreRequest;
use App\ScoreRequestFailed;
use App\ScoreRequestSuccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScoreRequestController extends Controller
{
    public function index()
    {
        $items = ScoreRequest::all();

        return view('admin.score_request.request.index', compact('items'));
    }

    public function check($id)
    {
        $scoreRequest = ScoreRequest::find($id);
        $socre = floor($scoreRequest->checkRemainTime($scoreRequest->student_id) / 18);
        $total_time = $scoreRequest->getStudentTime($scoreRequest->student_id);
        $items = SignUp::where('student_id',$scoreRequest->student_id)->where('pass','通過')->get();

        // 將有認列過的課程剃除 用foreach去確認SignUp的ID是否有出現過 沒出現的再推入陣列?或直接剃除
        $success_requsts = ScoreRequestSuccess::where('student_id',$scoreRequest->student_id)->pluck('passed_courses');
        $recorded_id = [];

        foreach($success_requsts as $SignUp_ary){
            $recorded_id = array_merge($recorded_id, json_decode($SignUp_ary));
        }


        return view('admin.score_request.request.check', compact('items', 'id', 'socre', 'total_time','recorded_id'));
    }

    public function success_index()
    {
        $items = ScoreRequestSuccess::all();

        return view('admin.score_request.success.index', compact('items'));
    }

    public function success_check($id)
    {
        $item = ScoreRequestFailed::find($id);

        return view('admin.score_request.success.check', compact('item'));
    }

    public function failed_index()
    {
        $items = ScoreRequestFailed::all();

        return view('admin.score_request.failed.index', compact('items'));
    }

    public function failed_check($id)
    {
        $item = ScoreRequestFailed::find($id);

        return view('admin.score_request.failed.check', compact('item'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        // 先確認是否時數有夠
        $remain_time = ScoreRequest::CheckRequestTime($user->account_id);

        if(18 > $remain_time){
            return redirect()->back()->with('error','');
        }

        // 再確認是否沒發過申請才建立
        $has_request = ScoreRequest::where('student_id',$user->account_id)->first();

        if($has_request){
            return redirect()->back()->with('fail','');
        }

        $new_record = new ScoreRequest();
        $new_record->student_id = $user->account_id;
        $new_record->save();

        return redirect()->back()->with('success','');
    }

    public function score_passed(Request $request, $id)
    {
        // 取得分數與找出當前已通過的報名清單
        $score = $request->score;
        $scoreRequest = ScoreRequest::find($id);
        $classes = SignUp::where('student_id',$scoreRequest->student_id)->where('pass','通過')->get();
        $class_id = [];

        // 已被記錄過的id
        $recorded_id = json_decode($request->recorded_id);

        // 先查看是否有已申請過的紀錄
        // 將有報名並通過的報名id記錄成ary方便查找
        if($recorded_id){
            foreach($classes as $class){
                if(!in_array($class->id,$recorded_id))
                    array_push($class_id, $class->id);
                }    
        }else{
            foreach($classes as $class){
                array_push($class_id, $class->id);
            }    
        }

        // 建立審核成功的紀錄
        $new_record = new ScoreRequestSuccess;
        $new_record->score = $score;
        $new_record->student_id = $scoreRequest->student_id;
        $new_record->passed_courses = json_encode($class_id);

        // 更新帳號紀錄的學分數
        $scoreRequest->student->score += $score;
        $scoreRequest->student->save();

        // 儲存新紀錄
        $new_record->save();

        // 請求刪除
        $scoreRequest->delete();
        
        return redirect('/micro-course/request');
    }

    public function acore_failed(Request $request, $id)
    {
        // 找出當前已通過的課程
        $scoreRequest = ScoreRequest::find($id);
        $classes = SignUp::where('student_id',$scoreRequest->student_id)->where('pass','通過')->get();
        $class_id = [];

        // 已被記錄過的id
        $recorded_id = json_decode($request->recorded_id);

        // 先查看是否有已申請過的紀錄
        // 將有報名並通過的報名id記錄成ary方便查找
        if($recorded_id){
            foreach($classes as $class){
                if(!in_array($class->id,$recorded_id))
                    array_push($class_id, $class->id);
                }    
        }else{
            foreach($classes as $class){
                array_push($class_id, $class->id);
            }    
        }

        // 建立並儲存審核不通過的新紀錄
        $new_record = new ScoreRequestFailed;
        $new_record->student_id = $scoreRequest->student_id;
        $new_record->passed_courses = json_encode($class_id);
        $new_record->save();

        // 請求刪除
        $scoreRequest->delete();
        
        return redirect('/micro-course/request');
    }
}
