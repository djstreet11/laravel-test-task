<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Link;

class RegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'phonenumber' => 'required|string|max:15',
        ]);

        $user = User::create([
            'username' => $request->username,
            'phonenumber' => $request->phonenumber
        ]);
        Auth::login($user);

        $link = Str::random(40);
        Link::create([
            'user_id' => $user->id,
            'link' => $link,
            'expires_at' => now()->addDays(7),
        ]);

        return redirect()->route('special_page', ['link' => $link]);
    }
}
