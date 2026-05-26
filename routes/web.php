<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/session-debug', function () {
    return [
        'app' => 'portal',
        'session_id' => session()->getId(),
        'nik' => Auth::user()?->nik,
        'cookie' => request()->cookie('promise_auth_session'),
        'config' => [
            'domain' => config('session.domain'),
            'path' => config('session.path'),
            'secure' => config('session.secure'),
        ]
    ];
});

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/debug-sso', function () {
    return [
        'auth_check' => Auth::check(),
        'auth_id' => Auth::id(),
        'session_id' => session()->getId(),
        'session_all' => session()->all(),
        'cookie' => request()->cookie(env('SESSION_COOKIE', 'promise_auth_session')),
    ];
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
