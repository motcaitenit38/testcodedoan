<?php

namespace App\Http\Controllers\Tuyendung\Auth;

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
    protected $redirectTo = '/tuyendung';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('tuyendung.guest:tuyendung', ['except' => 'logout']);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('tuyendung');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('tuyendung.auth.login');
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
        if(Auth::guard('tuyendung')->attempt(['email' => $email, 'password' => $password])){
            return redirect()->route('tuyendung.dashboard');
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

        return redirect('/tuyendung');
    }

}