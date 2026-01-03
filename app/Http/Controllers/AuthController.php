<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show Login Form
    public function showLogin()
    {
        return view('auth.login');
    }

    // Handle Standard Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Handle Login
    // Handle Login with Google
    public function loginWithGoogle(Request $request)
    {
        $request->validate([
            'id_token' => 'required|string',
        ]);

        $idTokenString = $request->input('id_token');

        try {
            $factory = (new \Kreait\Firebase\Factory)->withServiceAccount(config('firebase.credentials'));
            $auth = $factory->createAuth();
            $verifiedIdToken = $auth->verifyIdToken($idTokenString);
            $uid = $verifiedIdToken->claims()->get('sub');
            $email = $verifiedIdToken->claims()->get('email');
            $name = $verifiedIdToken->claims()->get('name');
            $picture = $verifiedIdToken->claims()->get('picture');

            // Find or create user
            $user = User::updateOrCreate(
                ['email' => $email],
                [
                    'nom' => $name, // Assuming full name, might need splitting or just storing in nom
                    'prenom' => '', // Placeholder if we only get one name field
                    'firebase_uid' => $uid,
                    'photo' => $picture,
                    'password' => null, // No password for Google users
                ]
            );

            Auth::login($user);

            return response()->json(['success' => true, 'redirect' => '/dashboard']);

        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => 'Authentication failed: ' . $e->getMessage()], 401);
        }
    }

    // Show Register Form
    public function showRegister()
    {
        return view('auth.register');
    }

    // Handle Register
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'tele' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
        }

        $user = User::create([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'tele' => $validated['tele'],
            'email' => $validated['email'],
            'password' => $validated['password'], // Casts will handle hashing
            'photo' => $path,
            'role' => 'student',
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
