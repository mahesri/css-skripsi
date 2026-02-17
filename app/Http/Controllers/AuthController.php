<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function showLogin()
    {
        return view('auth.showLogin');
    }

    public function register()
    {
        return view('auth.register');

    }

    public function login(Request $request){

    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

        if(Auth::attempt($credentials)) {

            $user = DB::table('users')->where('email', 'like', 
            $credentials['email'])->get();
            $userName = $user->pluck('name')->first();

            $roles = Role::all();

            session(['userName' => $userName, 'login' => true]);

            return view('/profile/setup', compact('userName', 'roles'));
        }

    return redirect()->route('auth.showLogin')->with('error', 
    'Your email or password is incorrect');

    }

    public function redirectToLinkedin()
    {
        return Socialite::driver('linkedin-openid')->redirect();
    }

    public function handleLinkedInCallback()
    {
        try {

            $linkedinUser = Socialite::driver('linkedin-openid')->stateless()->user();

            $roles = Role::all();

            $userName = $linkedinUser->getName();

            $user = User::firstOrCreate(
                ['email' => $linkedinUser->getEmail()],

                [
                    'name' => $linkedinUser->getName(),
                    'password' => Hash::make(Str::random(32)),
                    'email_verified_at' => now(),
                ]
            );

            Auth::login($user);

            return view('profile.setup', compact('userName', 'roles'));

        }catch (\Exception $e) {
            dd([
                    'error' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString()
                ]);}}

    public function store(Request $request)
    {

       User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password) // Hash the password
        ]);

        return redirect()->route('auth.showLogin')->with('message', 'Your registration was successful!');
    }
}
