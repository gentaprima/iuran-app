<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/','LoginController@index');
Route::get('/home','DashboardController@home');
Route::get('/verifikasi-warga','DashboardController@dataVerifikasiWarga');
Route::get('/data-warga','DashboardController@dataWarga');
Route::post('/auth','LoginController@auth');
Route::get('/register','LoginController@register');
Route::post('/process_register','LoginController@proccesRegister');
Route::get('/data-rekening','RekeningController@index');
Route::post('/add-rekening','RekeningController@store');
Route::post('/update-rekening/{id}','RekeningController@update');
Route::get('/delete-rekening/{id}','RekeningController@destroy');
Route::get('/profile','ProfileController@index');
Route::post('/update-profile/{id}','ProfileController@update');
Route::get('/warga/verif-data/{id}','WargaController@verifData');
Route::post('/warga/update/{id}','WargaController@update');
Route::get('/warga/delete/{id}','WargaController@destroy');
Route::get('/data-iuran','DashboardController@dataIuran');
Route::post('/add-iuran','IuranController@store');
Route::post('/update-iuran/{id}','IuranController@update');
Route::get('/delete-iuran/{id}','IuranController@destroy');
Route::get('/data-iuran-warga','DashboardController@dataIuranWarga');
Route::get('/tagih-iuran','IuranController@addBill');
Route::get('/data-jenis-iuran','DashboardController@jenisIuran');
Route::post('/add-jenis-iuran','JenisIuranController@store');
Route::post('/update-jenis-iuran/{id}','JenisIuranController@update');
Route::get('/delete-jenis-iuran/{id}','JenisIuranController@destroy');
Route::get('/form-tambah-iuran','DashboardController@formAddIuran');
Route::get('/form-update-iuran','DashboardController@formUpdateIuran');
Route::post('/add-new-iuran','IuranController@addIuran');
Route::get('/data-iuran-warga','DashboardController@verifikasiIuran');
Route::get('/get-data-users-by-id/{id}','WargaController@getDataById');
Route::get('/get-data-iuran-by-id/{id}','IuranController@getDataById');
Route::get('/confirm-iuran/{id}','IuranController@confirmIuran');
Route::get('/data-pemasukan','DashboardController@dataPemasukan');
Route::get('/logout',function(){
    Session::flush();
    return redirect('/');
});