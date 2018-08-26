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

Route::get('/','EmployeeController@index')->name('employee.index');
Route::get('/buscador','EmployeeController@buscador')->name('employee.buscador');
Route::get('/detalle/{id}','EmployeeController@detalle')->name("employee.detalle");
Route::get('/xml/{min}/{max}','EmployeeController@xml')->name('employee.xml');
