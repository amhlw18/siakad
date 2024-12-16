<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    //

    public function index()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        \Log::info('Login request data:', $request->all());



        $request->validate([
            'user_id' => 'required',
            'password' => 'required',
        ]);

        // Ambil user berdasarkan user_id
        $user = User::where('user_id', $request->user_id)->first();

        // Verifikasi password
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user); // Login user
            return response()->json([
                'success' => true,
                'message' => 'Login berhasil',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'User ID atau password salah',
        ]);
    }

    public function logout(Request $request)
    {
        // Log out the user
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the session token
        $request->session()->regenerateToken();

        // Redirect to the login page or homepage
        return redirect('/');
    }


}
