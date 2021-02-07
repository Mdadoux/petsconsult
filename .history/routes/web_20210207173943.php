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
use Illuminate\View\View;

Route::redirect('/', '/user_{user}/dashboard');

Auth::routes();

Route::get('/user_{user}/dashboard', 'HomeController@index')->name('dashboard');

Route::get('/user_{user}/consultations/search', 'ConsultationsController@searchAnimal')->name('search');
Route::get('/user_{user}/consultations/viewer/{consultation}', 'ConsultationsController@showApercu')->name('');
//Route::get('/consultations/{id}', 'ConsultationsController@list_consultations');
//Route::post('/', 'Auth\LoginController@userLogout');
Route::get('/add-proprietaires-form', function () {
    return view('pages.proprietaires.add-prop-form');
});
Route::get('/user_{user}/consultations/pdf/{consultation}', 'ConsultationsController@exportPdf')->name('pdf');
Route::resource('/user_{user}/proprietaires', 'ProprietairesController');
Route::resource('/user_{user}/consultations', 'ConsultationsController');
Route::resource('/user_{user}/patients', 'AnimalsController');