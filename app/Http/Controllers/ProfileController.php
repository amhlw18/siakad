<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Jenssegers\Agent\Agent;

class ProfileController extends Controller
{
    //
    public function index()
    {
        //dd(request()->header('User-Agent'));
        $user = Auth::user();

        $user = Auth::user();
        return view('profil.index', [
            'lastLogin' => $user->last_login_at,
            'userAgent' => $user->user_agent, // Informasi perangkat dan OS
        ]);
        //return view('profil.index',['lastLogin' => $user->last_login_at]);
    }

    public function uploadPhoto(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validasi file
        ]);


        try {
            // Simpan file ke folder 'profile-photos'
            $path = $request->file('photo')->store('profile-photos');

            if (Auth::user()->profile_picture){
                Storage::delete(Auth::user()->profile_picture);
            }

            Auth::user()->update(['profile_picture' => $path]);

            return response()->json([
                'success' => true,
                'message' => 'Foto berhasil diunggah!',
                //'file_path' => asset('storage/' . $path),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengunggah foto. Silakan coba lagi.',
            ], 500);
        }
    }

    public function update_password(Request $request)
    {

        try {
            $validasi = $request->validate([
                'password_lama' => 'required',
                'password' => 'required|confirmed|min:8',
            ],[
                'password_lama.required' => 'Password tidak boleh kosong',
                'password.required' => 'Password baru boleh kosong',
                'password.confirmed' => ' Password baru tidak sama !',
                'password.min' => ' Password minimal 8 karakter !'
            ]);

            // $pasword = $validasi['password'];

            if (!Hash::check($request->password_lama, Auth::user()->password)){
                return response()->json(['error' => 'Password lama anda salah !'], 422);
            }

            Auth::user()->update(['password' => Hash::make($request->password)]);

            return response()->json(['success' => 'Berhasil memperbarui password !']);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal memperbarui password, coba lagi!'], 500);
        }
    }

    public function update_profile(Request $request)
    {

        try {
            $validasi = $request->validate([
                'email' => 'required',
            ],[
                'email.required' => 'Email tidak boleh kosong !',

            ]);


            Auth::user()->update(['email' => $request->email]);

            return response()->json(['success' => 'Berhasil memperbarui email !']);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal memperbarui email, coba lagi!'], 500);
        }
    }
}
