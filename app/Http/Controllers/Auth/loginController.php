<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Providers\RouteServiceProvider;
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(LoginRequest $request)
    {
        $messages = [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Sai định dạng email',
            'password.required' => 'Password không được để trống',
        ];

        $credentials = $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ], $messages);

        if (auth()->attempt($credentials)) {
            if (auth()->user()->status == 1) {
                Auth::logout();
                return redirect()->back()->with(['error' => 'Tài khoản của bạn đã bị khóa.']);
            }else if (auth()->user()->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } else if (auth()->user()->role == 'editor') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('home1');
            }
        } else {
            return redirect()->route('login')
                ->with('error', 'Lỗi Đăng Nhập. Kiểm tra lại Email và Mật Khẩu của bạn.');
        }
    }
}
