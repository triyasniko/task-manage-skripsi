<?php

use Illuminate\Support\Facades\Route;

Auth::routes();
// Route::get('/admin', function () { 
//     return view('admin.homeAdmin'); 
// })->middleware('checkRole:admin')->name('admin.home');

// Route::get('/', function () { 
//     return view('home'); 
// })->name('home');
Route::middleware('auth')->group(function(){
    Route::get('/', 'UserController@index')->name('user.home');
    Route::post('/user/activity/store', 'UserController@storeActivity')->name('user.activity/store');
});


Route::middleware(['auth','checkRole:admin'])->group(function(){
    Route::get('/admin/', 'AdminController@index')->name('admin.index');
    Route::get('/admin/kriteria', 'AdminController@kriteria')->name('admin.kriteria');
    Route::get('/admin/kriteria/add', 'AdminController@addKriteria')->name('kriteria/add');
    Route::post('/admin/kriteria/store', 'AdminController@storeKriteria')->name('kriteria/store');
    Route::get('/admin/kriteria/edit/{id}', 'AdminController@editKriteria')->name('kriteria/edit');
    Route::post('/admin/kriteria/update', 'AdminController@updateKriteria')->name('kriteria/update');
    Route::get('/admin/kriteria/delete/{id}', 'AdminController@deleteKriteria')->name('kriteria/delete');

    Route::get('/admin/kriteria/rel_kriteria', 'AdminController@relKriteria')->name('admin.rel_kriteria');
    Route::post('/admin/kriteria/rel_kriteria/update', 'AdminController@updateRelKriteria')->name('admin.rel_kriteria.update');
    // Route::post('/kriteria/rel_kriteria/update',function(){
    //     echo "test masuk ke route";
    // })->name('admin.rel_kriteria.update');

    Route::get('/admin/alternative', 'AdminController@alternative')->name('admin.alternative');
    Route::get('/admin/alternative/add', 'AdminController@addAlternative')->name('alternative/add');
    Route::post('/admin/alternative/store', 'AdminController@storeAlternative')->name('alternative/store');
    Route::get('/admin/alternative/edit/{id}', 'AdminController@editAlternative')->name('alternative/edit');
    Route::post('/admin/alternative/update', 'AdminController@updateAlternative')->name('alternative/update');
    Route::get('/admin/alternative/delete/{id}', 'AdminController@deleteAlternative')->name('alternative/delete');
    
    Route::get('/admin/alternative/rel_alternative', 'AdminController@relAlternative')->name('admin.rel_alternative');
    Route::get('/admin/alternative/rel_alternative/edit/{kode_alternative}', 'AdminController@editRelAlternative')->name('admin.rel_alternative_edit');
    Route::post('/admin/alternative/rel_alternative/update', 'AdminController@updateRelAlternative')->name('admin.rel_alternative.update');
    
    Route::get('/admin/perhitungan', 'AdminController@perhitungan')->name('admin.perhitungan');

});


