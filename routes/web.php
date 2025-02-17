<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::prefix('api')->middleware('api')->group(function () {
    require __DIR__.'/api.php';
});
Route::get('/password/reset/{token}', function ($token) {
    return view('reset', ['token' => $token]);
})->name('password.reset');

Route::get('/', fn () => view('welcome'));
Route::post('/login', [AuthController::class, 'login']); 