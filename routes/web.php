<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;

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
    return view('welcome');
});

//el acceso debe pasar por el middleware auth y verified
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//el acceso debe pasar por el middleware auth y verified
Route::get('/student', function () {
    return view('student');
})->middleware(['auth', 'verified'])->name('student');

//*controlador de recursos User
Route::resource('users', UserController::class)->names('users');

//*rutas auth
require __DIR__.'/auth.php';