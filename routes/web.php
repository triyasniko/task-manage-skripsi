<?php

use Illuminate\Support\Facades\Route;

Auth::routes();
Route::middleware('auth')->group(function(){
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::get('/kriteria', 'AdminController@kriteria')->name('admin.kriteria');
    Route::get('/kriteria/add', 'AdminController@addKriteria')->name('kriteria/add');
    Route::post('/kriteria/store', 'AdminController@storeKriteria')->name('kriteria/store');
    Route::get('/kriteria/edit/{id}', 'AdminController@editKriteria')->name('kriteria/edit');
    Route::post('/kriteria/update', 'AdminController@updateKriteria')->name('kriteria/update');
    Route::get('/kriteria/delete/{id}', 'AdminController@deleteKriteria')->name('kriteria/delete');

    Route::get('/kriteria/rel_kriteria', 'AdminController@relKriteria')->name('admin.rel_kriteria');
    Route::post('/kriteria/rel_kriteria/update', 'AdminController@updateRelKriteria')->name('admin.rel_kriteria.update');
    // Route::post('/kriteria/rel_kriteria/update',function(){
    //     echo "test masuk ke route";
    // })->name('admin.rel_kriteria.update');

    Route::get('/alternative', 'AdminController@alternative')->name('admin.alternative');
    Route::get('/alternative/add', 'AdminController@addAlternative')->name('alternative/add');
    Route::post('/alternative/store', 'AdminController@storeAlternative')->name('alternative/store');
    Route::get('/alternative/edit/{id}', 'AdminController@editAlternative')->name('alternative/edit');
    Route::post('/alternative/update', 'AdminController@updateAlternative')->name('alternative/update');
    Route::get('/alternative/delete/{id}', 'AdminController@deleteAlternative')->name('alternative/delete');
    
    Route::get('/alternative/rel_alternative', 'AdminController@relAlternative')->name('admin.rel_alternative');
    Route::get('/alternative/rel_alternative/edit/{kode_alternative}', 'AdminController@editRelAlternative')->name('admin.rel_alternative_edit');
    Route::post('/alternative/rel_alternative/update', 'AdminController@updateRelAlternative')->name('admin.rel_alternative.update');
    
    Route::get('/perhitungan', 'AdminController@perhitungan')->name('admin.perhitungan');

});

// Route::get('/home', 'HomeController@index')->name('home');
