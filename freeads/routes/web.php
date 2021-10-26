<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\testCtrl;

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

Route::get('/', function () {
    return view('test', ['name'=>'Florian']);
});

Route::post('/search', [testCtrl::class, 'form']);

Route::get('/maths/{number}', [testCtrl::class, 'add']);
Route::get('/users', [testCtrl::class, 'viewUsers']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
