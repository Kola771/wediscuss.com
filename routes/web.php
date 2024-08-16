<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(["auth", "verified"])->group(function () {
    Route::get('/', [HomeController::class, "home"])->name("dashboard");

    Route::post("/user/block/{id}", [UserController::class, "blockUser"])->name('user.block');
    Route::post("/user/unblock/{id}", [UserController::class, "unblockUser"])->name('user.unblock');

    Route::get("/user/{user}", [MessageController::class, 'byUser'])->name("chat.user");
    Route::get("/group/{group}", [MessageController::class, 'byGroup'])->name("chat.group");
});

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
