<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\WhiteList;
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
        
        // 先判斷是否在白名單內
        $account_id = $request->email;
        $user = User::where('account_id', $account_id)->first();

        if($user && $user->role == 'student'){
            if(!WhiteList::where('student_id', $user->account_id)->first()){
                return $this->sendFailedLoginResponse($request); 
            }
        }

        // 判斷資料庫是否有資料 有則直接登入
        if($user){
            Auth::guard()->login($user);

            return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
        }

        // 如果沒帳號就需看SSO回應來決定是否須建立帳號
        if ($Account[0] == 0){
            return $this->sendFailedLoginResponse($request);
        }
        
        if ($Account[0] == 1) {
            // 確認SSO有回應且資料庫內沒有帳號時 開始解析資料並建立帳號
            $Account = array_values(array_filter($Account));
            $AccountData = array_slice($Account, 0, array_search($request->email, $Account));

            
            // 搜尋陣列中含有@的key值 然後將該key值以前的所有資料合併(除了key0), 並將當前該值儲存成email等待使用
            foreach($AccountData as $key => $data){
                if(strstr($data, "@") != false){
                    $name = join(array_slice( $AccountData , 1 , $key-1));
                    $email = $data;
                }      
            }

            // 建立帳號
            $user = User::create(['account_id' => $account_id]);
            
            $password = $request->password;

            $user->name = $name;
            $user->email = $email;
            $user->password = bcrypt($password);

            // 若是t代表為教師初次登入 將role改成教師
            $roleCheck = substr($account_id, 0, 1);
            
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
