<?php

use App\Http\Controllers\AtkController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    // return view('dashboard');
    // return Auth::user()->role;

    $role = Auth::user()->role;

    if($role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('user.dashboard');

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // admin
    Route::get('/admin', [AtkController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/atk', [AtkController::class, 'atkIndex'])->name('admin.atk');
    Route::get('/admin/atk/create', [AtkController::class, 'atkCreate'])->name('admin.atk.create');
    Route::post('/admin/atk/store', [AtkController::class, 'atkStore'])->name('admin.atk.store');
    Route::get('/admin/atk/edit/{id}', [AtkController::class, 'atkEdit'])->name('admin.atk.edit');
    Route::put('/admin/atk/update/{id}', [AtkController::class, 'atkUpdate'])->name('admin.atk.update');
    Route::get('/admin/atk/delete/{id}', [AtkController::class, 'atkDestroy'])->name('admin.atk.destroy');

    // user
    Route::get('/user', [AtkController::class, 'userDashboard'])->name('user.dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
