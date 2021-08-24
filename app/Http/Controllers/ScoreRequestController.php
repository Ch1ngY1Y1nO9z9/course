<?php

namespace App\Http\Controllers;

use App\SignUp;
use App\ScoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScoreRequestController extends Controller
{
    public function index()
    {
        $items = ScoreRequest::where('passed', '未審核')->get();

        return view('admin.score_request.index', compact('items'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        // 先確認是否時數有夠才建立
        $remain_time = ScoreRequest::CheckRequestTime($user->account_id);

        if(18 > $remain_time){
            return redirect()->back()->with('error','');
        }

        // 再確認是否沒發過申請才建立
        $has_request = ScoreRequest::where('student_id',$user->account_id)->where('passed','未審核')->first();

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
        $request = ScoreRequest::find($id);

        // 先拿到剩餘時間再轉換成可認列學分
        $score = floor($request->checkRemainTime($request->student_id) / 18);

        $request->passed = '通過';
        $request->score = $score;

        $request->student->score += $score;
        $request->student->save();

        $request->save();
        
        return redirect()->back();
    }

    public function acore_failed(Request $request, $id)
    {
        $request = ScoreRequest::find($id);

        $request->passed = '未通過';

        $request->save();
        
        return redirect()->back();
    }
}
