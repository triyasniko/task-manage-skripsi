<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'AdminController@index')->name('admin.index');
Route::get('/kriteria', 'AdminController@kriteria')->name('admin.kriteria');
Route::get('/kriteria/add', 'AdminController@addKriteria')->name('kriteria/add');
Route::post('/kriteria/store', 'AdminController@storeKriteria')->name('kriteria/store');
Route::get('/kriteria/edit/{id}', 'AdminController@editKriteria')->name('kriteria/edit');
Route::post('/kriteria/update', 'AdminController@updateKriteria')->name('kriteria/update');
Route::get('/kriteria/delete/{id}', 'AdminController@deleteKriteria')->name('kriteria/delete');
Route::get('/kriteria/nilai_bobot_kriteria', 'AdminController@nilaiBobotKriteria')->name('admin.nilai_bobot_kriteria');
Route::get('/alternative', 'AdminController@alternative')->name('admin.alternative');
Route::get('/alternative/nilai_bobot_alternative', 'AdminController@nilaiBobotAlternative')->name('admin.nilai_bobot_alternative');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
