<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    public function index()
    {
        // dd('test');
        return view('users.index');
    }

    public function signOut()
    {
        // log out the user
        auth()->logout();

        return redirect('/login')->with(['success' => 'Anda Telah Logout']);
    }
    // when the user visits the site
    public function showHomepage()
    {
        if (auth()->check()) {
            return view('homepage')->with(['success' => 'Selamat, anda telah login']);
        } else {
            return redirect('/login')->with(['error' => 'Tolong Login Terlebih Dahulu']);
        }
    }
    // showing the view ( Register page or Login page)
    public function showRegistrationForm()
    {
        return view('sign-up');
    }

    public function register(Request $request)
    {

        $formData = $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8'
        ]);

        // hash the password before saving
        $formData['password'] = bcrypt($formData['password']);

        // create new user and save into database
        $newUser = User::create($formData);

        // automatically log in the user
        auth()->login($newUser);
        Log::info('User ' . $newUser->username . ' registered');
        return redirect('/login')->with(['success' => 'Selamat Akun Kamu Sudah Berhasil Di Buat']);
    }
    public function showLoginForm()
    {
        return view('sign-in');
    }
    public function signIn(Request $request)
    {
        // validate the form
        $formdata = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // check if the user exists
        if (auth()->attempt(['email' => $formdata['email'], 'password' => $formdata['password']])) {
            Log::info('User ' . auth()->user()->username . ' logged in');
            return redirect('/')->with(['success' => 'Selamat, anda telah login']);
        } else {
            return redirect('/login')->with(['error' => 'Maaf Akun Anda Tidak Terdaftar']);
        }
    }
}
