<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/micro-course';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $Account = $this->checkAccount($request);
        
        // 記錄過多次嘗試登入
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);
        // 記錄過多次嘗試登入

        // 判斷登入
        if ($Account[0] == 0){
            return $this->sendFailedLoginResponse($request);
        }
        
        if ($Account[0] == 1) {

            // 確認資料返回成功後開始處理資料提供給帳號建立使用
            $Account = array_values(array_filter($Account));
            $AccountData = array_slice($Account, 0, array_search($request->email, $Account));

            // 驗證陣列中鍵值2的資料是否是信箱 若不是則將鍵值2和鍵值1合併 並重置陣列的鍵值
            if(stristr($AccountData[2], '@') == false){
                $AccountData[1] = $AccountData[1].$AccountData[2];
                unset($AccountData[2]);
                $AccountData = array_values($AccountData);
            }
            
            $user = User::firstOrCreate(['account_id' => $request->email]);

            if($user->name){
                Auth::guard()->login($user);

                return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());
            }

            // 以上都沒被執行代表沒有帳號 以下建立帳號並登入
            
            $password = $request->password;

            $user->name = $Account[1];
            $user->email = $Account[2];
            $user->password = bcrypt($password);

            // 查詢編號第一位是否為t
            $roleCheck = substr($request->email, 0, 1);
            // 若是t代表為教師初次登入 將role改成教師
            if($roleCheck == 't'){
                $user->role = 'teacher';
                $user->save();
            }else{
                $user->role = 'student';
                $user->save();
            }

            Auth::guard()->login($user);
            
            return $this->authenticated($request, $this->guard()->user())
                    ?: redirect()->intended($this->redirectPath());
        }
    }

    protected function checkAccount(Request $request)
    {
        $account = $request->email;
        $password = $request->password;
        $url = 'http://sais.csmu.edu.tw/eeptestcheckid/IDentityUser.aspx?account='.$account.'&password='.$password;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $reply = curl_exec($ch);
        curl_close($ch);

        $reply = mb_split("\s",$reply);

        return $reply;
    }
}
