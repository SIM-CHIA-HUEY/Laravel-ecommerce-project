<?php

use App\Http\Controllers\postadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\welcomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [welcomeController::class, 'index']);
Route::get('/category/{category}', [welcomeController::class, 'displayCategory']);
Route::post('/search', [welcomeController::class, 'search']);
Route::get('/postad', [postadController::class, 'index']);
Route::post('/postad', [postadController::class, 'post']);
/*

Route::post('/search', [testCtrl::class, 'form']);

Route::get('/maths/{number}', [testCtrl::class, 'add']);
Route::get('/users', [testCtrl::class, 'viewUsers']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
*/
require __DIR__.'/auth.php';
