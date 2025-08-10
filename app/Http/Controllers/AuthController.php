<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate inputs
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Find user by email
        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors(['email' => 'Invalid email or password'])->withInput();
        }

        // Log user in
        Auth::login($user);

        // Redirect based on role
        switch ($user->role) {
            case 'admin':
                return redirect()->route('dashboard');
            case 'teacher':
                return redirect()->route('teacher.dashboard');
            case 'student':
                return redirect()->route('student.dashboard');
            default:
                Auth::logout();
                return back()->withErrors(['email' => 'Your account role is invalid']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
