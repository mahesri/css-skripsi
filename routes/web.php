<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    $session = session('login');

    if($session === true){

        $roles = \App\Models\Role::all();
        $userName = session('userName');
        return view('/profile/setup', compact('userName', 'roles'));

    } else {
        return redirect('/auth');
    }
});

// Authentication Routing

Route::get('/auth', [\App\Http\Controllers\AuthController::class,
'showLogin'])->name('auth.showLogin');

Route::get('/auth/register', [\App\Http\Controllers\AuthController::class,
'register'])->name('auth.register');

Route::post('/auth/login',[\App\Http\Controllers\AuthController::class,
'login'])->name('auth.login');

Route::post('/auth/store',
[\App\Http\Controllers\AuthController::class,
'store'])->name('auth.store');


// Linkedin Authentication

Route::get('/auth/linkedin-openid',
    [\App\Http\Controllers\AuthController::class, 'redirectToLinkedin']);

Route::get('/auth/linkedin-openid/callback',
    [\App\Http\Controllers\AuthController::class, 'handleLinkedInCallback']);

// Route for profile set-up

Route::get('profile/setup', [\App\Http\Controllers\UserProfileController::class,
    'create'])->name('profile.create');

Route::post('profile/setup', [\App\Http\Controllers\UserProfileController::class,
    'store'])->name('profile.store');

Route::get('profile/result', [\App\Http\Controllers\UserProfileController::class,
    'result']);

Route::post('profile/setup', [\App\Http\Controllers\UserProfileController::class,
    'store'])
    ->name('profile.store');

Route::get('profile/result', [\App\Http\Controllers\UserProfileController::class,
    'result'])
    ->name('profile.result');

