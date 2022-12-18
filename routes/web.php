<?php

use App\Http\Controllers\Audit\AuditController;
use App\Http\Controllers\Audit\AuditReportController;
use App\Http\Controllers\Search\SearchLocalidadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\RoleController;
use App\Http\Controllers\User\RoleReportController;
use App\Http\Controllers\User\ShowProfileController;
use App\Http\Controllers\User\StudentAccountController;
use App\Http\Controllers\User\StudentProfileController;
use App\Http\Controllers\User\UserAccountController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\UserReportController;
use App\Http\Controllers\User\UserRoleController;
use App\Http\Controllers\House\AmbientTypeController;
use App\Http\Controllers\House\ServiceTypeController;

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


//TODO agrupar mejor las rutas.
//TODO middleware verified.

/**
 * * rutas de usuario administrador, perfil y cuenta
 * * rutas a perfil general (usuario administrador y estudiante)
 * * rutas a busqueda de localidades.
 * middleware:
 * - auth.
 * - verified.
 */
Route::middleware(['auth', 'verified'])->group(function () {
    
    //controlador de recursos User
    Route::resource('users', UserController::class)
        ->names('users');

    //reportes User
    Route::get('/report-users', [UserReportController::class, 'crear'])
        ->name('report-users');
    
    //*controlador de perfil de usuarios, mostrar perfil segun usuario, invocable
    Route::get('/user/profile', ShowProfileController::class)
        ->name('show-profile');

    //editar cuenta de acceso administrador (u otros roles internos)
    Route::get('/account-admin/{user}/edit', [UserAccountController::class, 'edit'])
        ->name('edit-account-admin');

    //actualizar cuenta de acceso administrador (u otros roles internos)
    Route::put('/account-admin/{user}', [UserAccountController::class, 'update'])
        ->name('update-account-admin');

    //eliminar cuenta de acceso de administrador (u otros roles internos)
    Route::delete('/account-admin/{user}', [UserAccountController::class, 'destroy'])
        ->name('delete-account-admin');

    //crear datos de perfil (datos personales) para un administrador (u otros roles internos)
    Route::get('/profile-admin/{user}/create', [UserProfileController::class, 'create'])
        ->name('create-profile-admin');

    //almacenar datos de perfil (datos personales) para un administrador (u otros roles internos)
    Route::post('/profile-admin/store', [UserProfileController::class, 'store'])
        ->name('store-profile-admin');

    //editar datos de perfil (datos personales) para un administrador (u otros roles internos)
    Route::get('/profile-admin/{user}/edit', [UserProfileController::class, 'edit'])
        ->name('edit-profile-admin');

    //actualizar datos de perfil (datos personales) para un administrador (u otros roles internos)
    Route::put('/profile-admin/{user}', [UserProfileController::class, 'update'])
        ->name('update-profile-admin');
    
    //*buscar localidad
    Route::post('/localidades/search', SearchLocalidadController::class)
        ->name('buscar-localidad');
});

/**
 * *rutas de estudiante, perfil y cuenta
 * middleware:
 * - auth.
 * - verified.
 */
Route::middleware(['auth','verified'])->group(function () {

    //editar cuenta de acceso estudiante (u otros roles academicos)
    Route::get('/account-student/{user}/edit', [StudentAccountController::class, 'edit'])
        ->name('edit-account-student');

    //actualizar cuenta de acceso estudiante (u otros roles academicos)
    Route::put('/account-student/{user}', [StudentAccountController::class, 'update'])
        ->name('update-account-student');

    //eliminar cuenta de acceso de estudiante (u otros roles academicos)
    Route::delete('/account-student/{user}', [StudentAccountController::class, 'destroy'])
        ->name('delete-account-student');

    //crear datos de perfil (datos personales) para un estudiante (u otros roles academicos)
    Route::get('/profile-student/{user}/create', [StudentProfileController::class, 'create'])
        ->name('create-profile-student');

    //almacenar datos de perfil (datos personales) para un estudiante (u otros roles academicos)
    Route::post('/profile-student/store', [StudentProfileController::class, 'store'])
        ->name('store-profile-student');

    //editar datos de perfil (datos personales) para un estudiante (u otros roles academicos)
    Route::get('/profile-student/{user}/edit', [StudentProfileController::class, 'edit'])
        ->name('edit-profile-student');

    //actualizar datos de perfil (datos personales) para un estudiante (u otros roles academicos)
    Route::put('/profile-student/{user}', [StudentProfileController::class, 'update'])
        ->name('update-profile-student');
});

/**
 * *rutas de roles y permisos.
 * middleware:
 * - auth.
 * - verified
 */
Route::middleware(['auth','verified'])->group(function () {

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

/**
 * *rutas de casa.
 * middleware:
 * - auth.
 * - verified.
 */
Route::middleware(['auth', 'verified'])->group(function () {

    //tipos de ambientes
    Route::resource('ambienttypes', AmbientTypeController::class)
        ->names('ambienttypes');
    
    //tipos de servicios
    Route::resource('servicetypes', ServiceTypeController::class)
        ->names('servicetypes');

});

/**
 * *rutas de auditoria.
 * middleware:
 * - auth.
 * - verified.
 */
Route::middleware(['auth','verified'])->group(function () {

    Route::get('audits', [AuditController::class, 'index'])
        ->name('audits.index');

    Route::get('audits/{audit}', [AuditController::class, 'show'])
        ->name('audits.show');

    //reportes Audit
    Route::get('/report-audits', [AuditReportController::class, 'crear'])
        ->name('report-audits');

    //reporte individual Audit
    Route::get('/report-audit/{audit}', [AuditReportController::class, 'crearIndividual'])
        ->name('report-audit');
    
});

//*rutas auth
require __DIR__.'/auth.php';