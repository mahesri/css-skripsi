<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/reflection/index', [\App\Http\Controllers\CriteriaController::class, 'index']);

Route::post('/posts', [\App\Http\Controllers\CriteriaController::class, 'store'])->name('/posts');
