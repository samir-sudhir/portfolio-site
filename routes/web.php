<?php

use Illuminate\Support\Facades\Route;

Route::prefix('api')->middleware('api')->group(base_path('routes/api.php'));
Route::get('/password/reset/{token}', function ($token) {
    return view('reset', ['token' => $token]);
})->name('password.reset');
