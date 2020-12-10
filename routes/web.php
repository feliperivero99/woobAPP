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
    return redirect()->route('usuarios');
});


/*Rutas de usuarios */

Route::match(['get', 'post'], '/Usuarios/{aviso?}', 'UserController@index')->name('usuarios');

Route::match(['get', 'post'], '/Usuarios-search', 'UserController@searchUsers')->name('usuariossearch');

Route::match(['get', 'post'], '/Usuarios-create', 'UserController@createuser')->name('usuarioscreate');

Route::match(['get', 'post'], '/Usuarios-edit/{id?}', 'UserController@editUser')->name('usuariosedit');

Route::match(['get', 'post'], '/Usuarios-delete', 'UserController@deletetUser')->name('usuariosdelete');