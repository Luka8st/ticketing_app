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
        Route::name('index.')->prefix('index')->group(function () {
            Route::get('/', [TicketController::class, 'index'])->name('all');
            Route::get('/new', [TicketController::class, 'indexNew'])->name('new');
            Route::get('/open', [TicketController::class, 'indexOpen'])->name('open');
            Route::get('/closed', [TicketController::class, 'indexClosed'])->name('closed');
        });

        Route::get('/create', [TicketController::class, 'create'])->name('create');
        Route::post('/', [TicketController::class, 'store'])->name('store');
        Route::delete('/{ticket}', [TicketController::class, 'destroy'])->name('destroy');
        Route::get('/{ticket}', [TicketController::class, 'edit'])->can('edit', 'ticket')->name('edit');
        Route::patch('/{ticket}', [TicketController::class, 'update'])->name('update');
        
        Route::get('/show/{ticket}', [TicketController::class, 'showTicketForClient'])->can('edit', 'ticket')->name('show');
    });
});

Route::middleware(['auth', 'agent'])->prefix('agent')->name('agent.')->group(function () {
    // Route::get('/', function () {
    //     // return view('agents.homepage', [
    //     //     'user' => Auth::user(), 
    //     //     'department' => Auth::user()->department()->with('tickets')->first()
    //     // ]);  

    //     return view('agents.homepage', ['tickets' => Auth::user()->ticketsForAgent()->where('status', 'open')->paginate(6)]);
    // })->name('homepage');

    Route::get('/', [TicketController::class, 'indexOpenedForAgent'])->name('homepage');

    Route::name('tickets.')->prefix('tickets')->group(function () {
        Route::patch('/close/{ticket}', [TicketController::class, 'close'])->can('changeStatus', 'ticket')->name('close');
        Route::get('/index', [TicketController::class, 'indexNewForAgent'])->name('indexNew');
        Route::patch('/open/{ticket}', [TicketController::class, 'open'])->can('changeStatus', 'ticket')->name('open');
        Route::get('/index-closed', [TicketController::class, 'indexClosedForAgent'])->name('indexClosed');

        Route::get('/show/{ticket}', [TicketController::class, 'showTicketForAgent'])->name('showNew');
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