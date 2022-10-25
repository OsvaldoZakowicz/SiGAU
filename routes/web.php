<?php

use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\RoleController;
use App\Http\Controllers\User\RoleReportController;
use App\Http\Controllers\User\ShowProfileController;
use App\Http\Controllers\User\StudentProfileController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\UserReportController;
use App\Http\Controllers\User\UserRoleController;

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

//vista publica
Route::get('/', function () {
    return view('welcome');
});

//el acceso debe pasar por el middleware auth, verified, permission
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'permission:ver-pagina-dashboard'])->name('dashboard');


//el acceso debe pasar por el middleware auth, verified, role
Route::get('/student', function () {
    return view('student');
})->middleware(['auth', 'verified', 'permission:ver-pagina-estudiante'])->name('student');


//rutas recursos, middleware en los controladores
Route::middleware(['auth'])->group(function () {
    
    //controlador de recursos User
    Route::resource('users', UserController::class)
        ->names('users');

    //reportes User
    Route::get('/report-users', [UserReportController::class, 'crear'])
        ->name('report-users');
    
    //controlador de perfil de usuarios, mostrar perfil segun usuario, invocable
    Route::get('/user/profile', ShowProfileController::class)
        ->name('show-profile');

    //editar perfil administrador (u otros roles internos)
    Route::get('/profile-admin/{user}/edit', [UserProfileController::class, 'edit'])
        ->name('edit-admin');

    //actualizar perfil administrador (u otros roles internos)
    Route::put('/profile-admin/{user}', [UserProfileController::class, 'update'])
        ->name('update-admin');

    //eliminar perfil de administrador (u otros roles internos)
    Route::delete('/profile-admin/{user}', [UserProfileController::class, 'destroy'])
        ->name('delete-admin');

    //editar perfil estudiante (becado o delegado)
    Route::get('/profile-student/{user}/edit', [StudentProfileController::class, 'edit'])
        ->name('edit-student');

    //actualizar perfil estudiante (becado o delegado)
    Route::put('/profile-student/{user}', [StudentProfileController::class, 'update'])
        ->name('update-student');

    //eliminar perfil estudiante (becado o delegado)
    Route::delete('/profile-student/{user}', [StudentProfileController::class, 'destroy'])
        ->name('delete-student');
    
    //controlador de recursos Roles
    Route::resource('roles', RoleController::class)
        ->names('roles');

    //reportes Roles
    Route::get('/report-roles', [RoleReportController::class, 'crear'])
        ->name('report-roles');
    
    //asignar rol al usuario
    Route::get('/user/{user}/edit-role', [UserRoleController::class, 'edit'])
        ->name('edit-role');
    
    //actualizar rol al usuario
    Route::put('/user/{user}', [UserRoleController::class, 'assignUserRole'])
        ->name('assign-role');

    //inhabilitar usuario interno
    Route::delete('/user/{user}', [UserRoleController::class, 'disableUserRole'])
        ->name('disable-role');
    
});


//*rutas auth
require __DIR__.'/auth.php';