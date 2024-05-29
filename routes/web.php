<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TicketController;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::delete('/logout', [SessionController::class, 'destroy'])->middleware('auth');

Route::middleware(['auth', 'client'])->prefix('client')->name('client.')->group(function () {
    Route::get('/', function () {
        return view('welcome');  
    })->name('homepage');

    Route::name('tickets.')->prefix('tickets')->group(function () {
        Route::get('/', [TicketController::class, 'index'])->name('index');
        Route::get('/create', [TicketController::class, 'create'])->name('create');
        Route::post('/', [TicketController::class, 'store'])->name('store');
        Route::delete('/{ticket}', [TicketController::class, 'destroy'])->name('destroy');
        Route::get('/{ticket}', [TicketController::class, 'edit'])->can('edit', 'ticket')->name('edit');
        Route::patch('/{ticket}', [TicketController::class, 'update'])->name('update');
    });
});

Route::middleware(['auth', 'agent'])->prefix('agent')->name('agent.')->group(function () {
    Route::get('/', function () {
        // return view('agents.homepage', [
        //     'user' => Auth::user(), 
        //     'department' => Auth::user()->department()->with('tickets')->first()
        // ]);  

        return view('agents.homepage', ['tickets' => Auth::user()->ticketsForAgent()->where('status', 'open')->get()]);
    })->name('homepage');

    Route::name('tickets.')->prefix('tickets')->group(function () {
        Route::patch('/close/{ticket}', [TicketController::class, 'close'])->can('close', 'ticket')->name('close');
    });
});

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('welcome');    
    });
    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
});

Route::get('/departments', [DepartmentController::class, 'index']);