<?php

use Illuminate\Support\Facades\Route;

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


/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('admin-users')->name('admin-users/')->group(static function() {
            Route::get('/',                                             'AdminUsersController@index')->name('index');
            Route::get('/create',                                       'AdminUsersController@create')->name('create');
            Route::post('/',                                            'AdminUsersController@store')->name('store');
            Route::get('/{adminUser}/impersonal-login',                 'AdminUsersController@impersonalLogin')->name('impersonal-login');
            Route::get('/{adminUser}/edit',                             'AdminUsersController@edit')->name('edit');
            Route::post('/{adminUser}',                                 'AdminUsersController@update')->name('update');
            Route::delete('/{adminUser}',                               'AdminUsersController@destroy')->name('destroy');
            Route::get('/{adminUser}/resend-activation',                'AdminUsersController@resendActivationEmail')->name('resendActivationEmail');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::get('/profile',                                      'ProfileController@editProfile')->name('edit-profile');
        Route::post('/profile',                                     'ProfileController@updateProfile')->name('update-profile');
        Route::get('/password',                                     'ProfileController@editPassword')->name('edit-password');
        Route::post('/password',                                    'ProfileController@updatePassword')->name('update-password');
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('tareas')->name('tareas/')->group(static function() {
            Route::get('/',                                             'TareasController@index')->name('index');
            Route::get('/create',                                       'TareasController@create')->name('create');
            Route::post('/',                                            'TareasController@store')->name('store');
            Route::get('/{tarea}/edit',                                 'TareasController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'TareasController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{tarea}',                                     'TareasController@update')->name('update');
            Route::delete('/{tarea}',                                   'TareasController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('dependencias')->name('dependencias/')->group(static function() {
            Route::get('/',                                             'DependenciasController@index')->name('index');
            Route::get('/create',                                       'DependenciasController@create')->name('create');
            Route::post('/',                                            'DependenciasController@store')->name('store');
            Route::get('/{dependencium}/edit',                          'DependenciasController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'DependenciasController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{dependencium}',                              'DependenciasController@update')->name('update');
            Route::delete('/{dependencium}',                            'DependenciasController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('items')->name('items/')->group(static function() {
            Route::get('/',                                             'ItemsController@index')->name('index');
            Route::get('/create',                                       'ItemsController@create')->name('create');
            Route::post('/',                                            'ItemsController@store')->name('store');
            Route::get('/{item}/edit',                                  'ItemsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'ItemsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{item}',                                      'ItemsController@update')->name('update');
            Route::delete('/{item}',                                    'ItemsController@destroy')->name('destroy');
        });
    });
});