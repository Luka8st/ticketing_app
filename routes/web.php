<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TicketController;
use App\Models\Department;
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

Route::get('/', function () {
    return view('welcome');    
});

// Route::get('/', [JobController::class, 'index']);
// Route::get('/jobs/create', [JobController::class, 'create'])->middleware('auth');
// Route::post('/jobs', [JobController::class, 'store'])->middleware('auth');
// Route::get('/search', SearchController::class);
// Route::get('/tags/{tag:name}', TagController::class);

Route::middleware('auth')->group(function () {
    Route::delete('/logout', [SessionController::class, 'destroy']);

    Route::get('/tickets', [TicketController::class, 'index']);
    Route::get('/tickets/create', [TicketController::class, 'create']);
    Route::post('/tickets', [TicketController::class, 'store']);
    Route::delete('/tickets/{ticket}', [TicketController::class, 'destroy']);
    Route::get('/tickets/{ticket}', [TicketController::class, 'edit'])->can('edit', 'ticket');
    Route::patch('/tickets/{ticket}', [TicketController::class, 'update']);
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
});

Route::get('/departments', [DepartmentController::class, 'index']);