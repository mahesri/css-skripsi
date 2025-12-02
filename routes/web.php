<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/reflection/index', [\App\Http\Controllers\CriteriaController::class, 'index']);

Route::post('/posts', [\App\Http\Controllers\CriteriaController::class, 'store'])->name('/posts');

// Linkedin Authentication

Route::get('/auth/linkedin-openid', [\App\Http\Controllers\LinkedInController::class, 'redirectToLinkedin']);

Route::get('/auth/linkedin-openid/callback', [\App\Http\Controllers\LinkedInController::class, 'handleLinkedInCallback']);

// Route for profile set-up

Route::get('profile/setup', [\App\Http\Controllers\UserProfileController::class, 'create'])->name('profile.create');

Route::post('profile/setup', [\App\Http\Controllers\UserProfileController::class, 'store'])->name('profile.store');

Route::get('profile/result', [\App\Http\Controllers\UserProfileController::class, 'result'])->name('profile.result');
