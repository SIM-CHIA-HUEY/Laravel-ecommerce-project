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
Route::get('/search', [welcomeController::class, 'index']);

Route::get('/postad', [postadController::class, 'index']);
Route::post('/postad', [postadController::class, 'post']);

Route::get('/page/{number}', [welcomeController::class, 'displayPage']);
require __DIR__.'/auth.php';
