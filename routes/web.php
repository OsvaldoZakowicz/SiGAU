<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\RoleController;
use App\Http\Controllers\User\UserReportController;

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

//*vista publica
Route::get('/', function () {
    return view('welcome');
});

//*el acceso debe pasar por el middleware auth, verified, permission
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'permission:ver-pagina-dashboard'])->name('dashboard');


//*el acceso debe pasar por el middleware auth, verified, role
Route::get('/student', function () {
    return view('student');
})->middleware(['auth', 'verified', 'permission:ver-pagina-estudiante'])->name('student');


//*rutas recursos, middleware en los controladores
Route::middleware(['auth'])->group(function () {
    
    //*controlador de recursos User
    Route::resource('users', UserController::class)->names('users');
    //*reportes User
    Route::get('/report-users', [UserReportController::class, 'crear'])->name('report-users');
    
    Route::resource('roles', RoleController::class)->names('roles');
});


//*rutas auth
require __DIR__.'/auth.php';