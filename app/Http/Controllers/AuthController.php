<?php

namespace App\Http\Controllers;

use App\Models\AuthModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth as AuthLogin;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function regisPage()
    {
        return view('auth.register');
    }

    public function register_store(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed|min:5',
            'name' => 'required',
        ], [
            'name.required' => "Field nama wajib di isi.",
        ]);

        $checkEmail = AuthModel::where('email', $request->email)->first();
        if ($checkEmail) {
            return redirect()->back()->with('error', 'email sudah terdaftar');
        }

        AuthModel::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(60),
        ]);
        return redirect('/login')->with('successRegist', 'Akunmu berhasil didaftarkan 😍');
    }


    public function loginPage()
    {
        return view('auth.login');
    }

    public function login_store(Request $request)
    {
        if (AuthLogin::attempt(['email' => $request->email, 'password' => $request->password])) {

            $time = 360;
            $response = new Response(redirect('/')->with('berhasilLogin', 'Selamat Datang Di Pyarr'));
            if ($request->has('remember')) {
                $response->withCookie(Cookie("inalum", "inalum", $time));
                return $response;
            } else {
                return redirect('/')->with('berhasilLogin', 'Selamat Datang Di Pyarr');
            }

        } else {
            return redirect()->back()->with('wrongAuth', 'Email atau Password tidak sesuai');
        }
    }

    public function logout()
    {
        AuthLogin::logout();
        return redirect('/login');
    }

    public function lupaPassword_page()
    {
        return view('auth.lupaPassword');
    }

    public function lupaPassword_store(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Ambil user berdasarkan email
        $user = AuthModel::where("email", $request->email)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'Email tidak ditemukan.');
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);
        return redirect("/login")->with('success', 'Password berhasil diubah!');
    }
}
