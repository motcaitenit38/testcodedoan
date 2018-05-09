<?php

namespace App\Http\Controllers\Timviec\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/timviec';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('timviec.guest:timviec', ['except' => 'logout']);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('timviec');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('timviec.auth.login');
    }

    public function login(Request $request){
        $this->validate($request,[
            'email'=>'required|email'
        ],
        [
            'email.required'=>'chua nhap email',
            'email.email'=>'email khong dung dinh dang'
        ]);
        $email = $request['email'];
        $password = $request['password'];
        if(Auth::guard('timviec')->attempt(['email' => $email, 'password' => $password])){
            echo "Đăng nhập trang tìm việc thành công";
        }else{            
            return redirect()->back()->withInput()->with('thongbao','Email hoặc mật khẩu không đúng');
        }
    }

    /**
     * Log the user out of the application.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {

        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/timviec');
    }

}