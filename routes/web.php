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

Route::get('/', function() {
	return view('login');
})->middleware('guest')->name('login');
Route::post('/kirimlogin', 'AuthController@login')->name('kirimlogin');
Route::get('/logout','AuthController@logout')->name('logout');
Route::get('/auto_logout','AuthController@autoLogout')->name('auto.logout');

Route::get('/refresh_cap','AuthController@refreshCaptcha')->name('refresh');

Route::group(['prefix'=>'user','middleware'=>['auth:pasien']], function() {
	Route::get('/', 'PortalController@index')->name('home');
	Route::get('/rajal', 'PortalController@rajal')->name('rwyt.rajal');
	Route::get('/ranap', 'PortalController@ranap')->name('rwyt.ranap');
	Route::get('/hibo', 'PortalController@hibooking')->name('rwyt.booking');

	// Route::get('/jadwal', function() {
	// 	return view('portal.jadwal');
	// })->name('jadwal');

	Route::get('/dftr_klinik', 'PortalController@dftr_klinik')->name('dftr.klinik');
	Route::get('/dokter', 'ProsesController@find_dokter');

	Route::get('/nobooking', 'PortalController@nobooking');
	Route::get('/nourut', 'PortalController@nourut');

	Route::get('/dftr_dokter', 'PortalController@dftr_dokter')->name('dftr.dokter');
	Route::get('/klinik', 'ProsesController@find_klinik');

	Route::get('/jdwl_dokter', 'ProsesController@jdwl_dokter');
	Route::post('/save', 'ProsesController@save_form')->name('s.form');
});

// Route::get('/send', 'ProsesController@send')->name('send.kes');
