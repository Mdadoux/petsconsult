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

use App\Consultation;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');


Route::resource('/consultations', 'ConsultationsController');
Route::resource('/patients', 'AnimalsController');
//Route::get('/consultations/{id}', 'ConsultationsController@list_consultations');
//Route::post('/', 'Auth\LoginController@userLogout');
