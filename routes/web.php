<?php

use App\Http\Controllers\AtkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
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
    // master atk
    Route::get('/admin', [AtkController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/atk', [AtkController::class, 'atkIndex'])->name('admin.atk');
    Route::get('/admin/atk/create', [AtkController::class, 'atkCreate'])->name('admin.atk.create');
    Route::post('/admin/atk/store', [AtkController::class, 'atkStore'])->name('admin.atk.store');
    Route::get('/admin/atk/edit/{id}', [AtkController::class, 'atkEdit'])->name('admin.atk.edit');
    Route::put('/admin/atk/update/{id}', [AtkController::class, 'atkUpdate'])->name('admin.atk.update');
    Route::get('/admin/atk/delete/{id}', [AtkController::class, 'atkDestroy'])->name('admin.atk.destroy');

    // transaksi atk
    Route::get('/admin/atk/transaksi', [AtkController::class, 'atkTransaksi'])->name('admin.atk.transaksi');
    Route::get('/admin/atk/transaksi/create', [AtkController::class, 'atkTransaksiCreate'])->name('admin.atk.transaksi.create');
    Route::post('/admin/atk/transaksi/store', [AtkController::class, 'atkTransaksiStore'])->name('admin.atk.transaksi.store');

    // tickets
    Route::get('/admin/tickets', [TicketController::class, 'index'])->name('admin.tickets');
    Route::get('/admin/tickets/create', [TicketController::class, 'ticketCreate'])->name('admin.tickets.create');
    Route::post('/admin/tickets/store', [TicketController::class, 'ticketStore'])->name('admin.tickets.store');

    // get ticket
    Route::get('/admin/getticket', [TicketController::class, 'getTicketIndex'])->name('admin.tickets.get');
    Route::get('/admin/getticket/create', [TicketController::class, 'getTicketCreate'])->name('admin.tickets.get.create');
    Route::post('/admin/getticket/store', [TicketController::class, 'getTicketStore'])->name('admin.tickets.get.store');
    Route::get('/admin/getticket/edit/{id}', [TicketController::class, 'getTicketEdit'])->name('admin.tickets.get.edit');
    Route::post('/admin/getticket/update/{id}', [TicketController::class, 'getTicketUpdate'])->name('admin.tickets.get.update');

    // user
    Route::get('/user', [AtkController::class, 'userDashboard'])->name('user.dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
