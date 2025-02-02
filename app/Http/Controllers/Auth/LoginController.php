<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ], [
            'email.required' => 'Kolom email wajib diisi',
            'email.email' => 'Email yang dimasukkan tidak valid',
            'password.required' => 'Kolom password wajib diisi',
            'password.string' => 'Kolom password harus berupa teks dan angka',
            'password.min' => 'Panjang password minimal harus 6 karakter',
        ]);
    
        $login = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(auth()->attempt($login)){
            return redirect()->route('dashboard')->with(['success' => 'Anda berhasil Login !']);
        }
        return redirect()->route('login')->with(['error' => 'Email / Password Anda salah !']);
    }


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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

     public function __construct()
     {
         $this->middleware('guest')->except('logout');
     }
     
    
    public function logout(Request $request)
    {
        $this->guard()->logout();
    
        $request->session()->invalidate();
    
        return redirect('/login')->with('success', 'Anda berhasil telah keluar!');
    }
    
}