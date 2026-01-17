<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use function Laravel\Prompts\password;

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

            $user = DB::table('users')->where('email', 'like', $credentials['email'])->get();

            $request->session()->regenerate();
            $userName = $user->pluck('name')->first();

            session(['userName:' => $userName]);

            $roles = Role::all();

            return view('/profile/setup', compact('userName', 'roles'));
        }

    return redirect()->route('auth.showLogin')->with('error', 'Your email or password is incorrect');

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
                ]
            );
        }
    }

    public function store(Request $request)
    {

//        $request->validate([
//            'name' => ['required', 'string', 'max:255'],
//            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
//            'password' => 'required|min:6|confirmed'
//        ]);

       User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password) // Hash the password
        ]);

//        Auth::login($user);

//        return redirect()->route('/')->with('success', 'Kamu sudah terdaftar!');

        return redirect()->route('auth.showLogin')->with('message', 'Your registration was successful!');
    }
}
