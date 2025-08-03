<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function create(Request $request)
    {
        $validation = $request->validate([
            'register_name' => ['required', 'string'],
            'register_email' => ['required', 'email', 'unique:users,email'],
            'register_password' => ['required', 'string', 'confirmed', Password::min(8)->numbers()],
        ]);

        User::create([
            'name' => $validation['register_name'],
            'email' => $validation['register_email'],
            'password' => $validation['register_password']
        ]);

        return redirect()->route('login')->with('success', 'Registered successfully!, You can now login with your credentials.');
    }
    
    public function store(Request $request)
    {
        $validation = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! Auth::attempt($validation)) {
            throw ValidationException::withMessages([
                'email' => 'Invalid email or password.',
                'password' => 'Invalid email or password.',
            ]);
        }

        request()->session()->regenerate();

        return redirect()->route('home')->with('success', "Logged in successfully!");
    }

    public function show()
    {
        $user = Auth::user();

        return view('users.show', compact('user'));
    }

    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $validation = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id . ',id'],
        ]);

        $user->name = $validation['name'];
        $user->email = $validation['email'];

        $user->save();

        return redirect()->route('profile')->with('success', 'Update data successful!');
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }

    public function delete(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        Auth::logout();
        $user->delete();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Your account has been deleted!');
    }
}
