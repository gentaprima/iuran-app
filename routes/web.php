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
Route::get('/data-warga','DashboardController@dataWarga');
Route::post('/auth','LoginController@auth');
Route::get('/register','LoginController@register');
Route::post('/process_register','LoginController@proccesRegister');

Route::get('/logout',function(){
    Session::flush();
    return redirect('/');
});