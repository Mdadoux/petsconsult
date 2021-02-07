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

Route::redirect('/', '/dashboard');

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::get('/consultations/search', 'ConsultationsController@searchAnimal')->name('search');
Route::get('/consultations/viewer/{consultation}', 'ConsultationsController@showApercu')->name('viewer');
//Route::get('/consultations/{id}', 'ConsultationsController@list_consultations');
//Route::post('/', 'Auth\LoginController@userLogout');
Route::get('/add-proprietaires-form', function () {
    return view('pages.proprietaires.add-prop-form');
});
Route::get('/consultations/pdf/{consultation}', 'ConsultationsController@exportPdf')->name('pdf');
Route::resource('/proprietaires', 'ProprietairesController');
Route::resource('/consultations', 'ConsultationsController');
Route::resource('/patients', 'AnimalsController');