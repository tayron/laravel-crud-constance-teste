<?php

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
Route::get('/', 'UserController@index')->name('usuarios');

// Routers for Profiles
Route::get('/perfis', 'ProfileController@index')->name('perfis');
Route::get('/perfil/novo', 'ProfileController@create')->name('perfil_novo');
Route::post('/perfil/salvar', 'ProfileController@store')->name('perfil_salvar');
Route::get('/perfil/editar/{id}', 'ProfileController@edit')->name('perfil_editar');
Route::post('/perfil/atualizar', 'ProfileController@update')->name('perfil_atualizar');
Route::post('/perfil/excluir', 'ProfileController@destroy')->name('perfil_excluir');

// Routers for User
Route::get('/usuarios', 'UserController@index')->name('usuarios');
Route::get('/usuario/novo', 'UserController@create')->name('usuario_novo');
Route::post('/usuario/salvar', 'UserController@store')->name('usuario_salvar');
Route::get('/usuario/editar/{id}', 'UserController@edit')->name('usuario_editar');
Route::post('/usuario/atualizar', 'UserController@update')->name('usuario_atualizar');
Route::post('/usuario/excluir', 'UserController@destroy')->name('usuario_excluir');


