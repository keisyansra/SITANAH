<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
    
    public function login() {
        if(Auth::check()) { // jika sudah login maka redirect ke halaman home 
            return redirect('/');
        }
        return view('auth.login');
    }

    public function postlogin(Request $request) {
        if($request->ajax() || $request->wantsJson()) {
            $credentials = [
                'username_user' => $request->username_user,
                'password' => $request->password_user, // WAJIB pakai key ini!
            ];
    
            if(Auth::attempt($credentials)) {
                return response()->json([
                    'status' => 'true',
                    'message' => 'Login berhasil',
                    'redirect' => url('/')
                ]);
            }
    
            return response()->json([
                'status' => false,
                'message' => 'Username atau password salah'
            ]);
        }
    
        return redirect('login');
    }
    

    public function logout(Request $request) {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}