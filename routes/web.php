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
    return redirect('/login');
});
Route::get('/login','AuthController@login')->name('login');
Route::post('/postlogin','AuthController@postlogin')->name('postlogin');
Route::get('/logout','AuthController@logout')->name('logout');

// Route::get('test', function(){
//     return Http::withBasicAuth('test','qwerty')->get('http://103.211.82.20/api/sign/download/80aa89652ada4e6cbec8645b0b3ac45f');        
// });


//superadmin
Route::get('/super/instansi','SuperadminController@instansi_index')->name('super-instansi');
Route::post('/super/instansi/create','SuperadminController@create')->name('create-instansi');
Route::get('/super/instansi/edit/{id}','SuperadminController@update_index');
Route::post('/super/instansi/update/{id}','SuperadminController@update');
Route::get('/super/instansi/delete/{id}','SuperadminController@delete');
Route::get('/super/user','SuperadminController@user_index')->name('super-user');
Route::post('/super/user/create','SuperadminController@create_user')->name('create-user');
Route::get('/super/user/edit/{id}','SuperadminController@update_user_index');
Route::post('/super/user/update/{id}','SuperadminController@update_user');

//admin dinas
Route::get('/admin/pengajuan','AdminController@pengajuan')->name('adm-pengajuan');
Route::post('/admin/uploadpdf','AdminController@uploadpdf')->name('uploadpdf');
Route::get('/admin/deletepdf{id}','AdminController@deletepdf')->name('deletepdf');
