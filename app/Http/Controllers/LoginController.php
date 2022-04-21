<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login', ['title' => 'Login']);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role == '2' || $user->role == '3') {
                $request->session()->regenerate();
                return redirect()->intended('/');
            } elseif ($user->role == '1') {
                $request->session()->regenerate();
                return redirect()->intended('/dashboard');
            }
        }

        return back()->with('loginError', 'Login failed!');
    }

    public function resetpw()
    {

        return view('auth.resetpw');
    }

    public function sendlink()
    {
        request()->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $token = \Str::random(64);
        \DB::table('password_resets')->insert([
            'email' => request()->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        $action_link = route('formpw', ['token' => $token, 'email' => request()->email]);
        $body = "We are received a request to reset the password for <b>Konsultasi Hama Kedelai </b> account associated with " . request()->email . ". You can reset your password by clicking the link below";

        \Mail::send('auth/email-forgot', ['action_link' => $action_link, 'body' => $body], function ($message) {
            $message->from('fitridwirahma11@gmail.com', 'Konsultasi Hama Kedelai');
            $message->to(request()->email, 'Fitri Dwi')
                ->subject('Reset Password');
        });

        return back()->with('info', 'Silahkan periksa kotak masuk email anda.');
    }

    public function formpw($token = null)
    {
        return view('auth.formpw')->with(['token' => $token, 'email' => request()->email]);
    }

    public function reset_password()
    {
        request()->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|max:255',
        ]);

        $check_token = \DB::table('password_resets')->where([
            'email' => request()->email,
            'token' => request()->token
        ])->first();

        if (!$check_token) {
            return back()->withInput()->with('failed', 'Token Salah!');
        } else {
            User::where('email', request()->email)->update([
                'password' => \Hash::make(request()->password)
            ]);

            \DB::table('password_resets')->where([
                'email' => request()->email
            ])->delete();

            return redirect()->route('login')->with('success', 'Kata Sandi Berhasil Di ubah.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
