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

Auth::routes();

Route::get('/home/a', 'TenantController@a');

Route::group(['middleware' => 'revalidate'], function()
{
Route::get('/', function () {
    return redirect()->route('home');
});


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/jsont', 'HomeController@jsontenant');
Route::get('/home/jsonw', 'HomeController@jsonwisata');
// Route::get('/home/create', 'HomeController@create')->name('create');
// Route::post('/home/store', 'HomeController@store')->name('store');
// Route::PUT('home/{poss_id}','HomeController@update')->name('update');
// Route::GET('home/{poss_id}/edit','HomeController@edit')->name('edit');

Route::get('/coba', 'CobaController@index');


Route::get('/tenant', 'TenantController@index')->name('tenant.index');
// Route::get('/home/create', 'HomeController@create')->name('create');
Route::post('/tenant/store', 'TenantController@store')->name('tenant.store');
// Route::PUT('home/{poss_id}','HomeController@update')->name('update');
Route::GET('tenant/edit/{id}','TenantController@edit')->name('tenant.edit');
Route::PUT('tenant/{id}','TenantController@update')->name('tenant.update');
Route::DELETE('tenant/{id}/destroy','TenantController@destroy')->name('tenant.destroy');

Route::get('/ab', 'TenantController@ab');
Route::get('/wisata', 'WisataController@index')->name('wisata.index');
Route::post('/wisata', 'WisataController@store')->name('wisata.store');
Route::GET('wisata/{poss_id}/edit','WisataController@edit')->name('wisata.edit');
Route::PUT('wisata/{poss_id}','WisataController@update')->name('wisata.update');
Route::DELETE('wisata/{poss_id}','WisataController@destroy')->name('wisata.destroy');
Route::get('/wisata/dataw', 'WisataController@dataw');
Route::resource('panduan', 'PanduanController');
Route::resource('asisten', 'AsistenController');

//Route Master Data
Route::get('/master', 'MasterController@index')->name('master.index');
//Master Data Tenant
Route::GET('/master/tenant', 'MasterController@tenantindex')->name('masterte.index');
Route::POST('/master/tenant/store', 'MasterController@tenantstore')->name('masterte.store');
Route::GET('master/tenant/edit/{poss_id}','MasterController@tenantedit')->name('masterte.edit');
Route::PUT('master/tenant/{poss_id}','MasterController@tenantupdate')->name('masterte.update');
Route::DELETE('master/tenant/{poss_id}/destroy','MasterController@tenantdestroy')->name('masterte.destroy');

//Master Data Tenant
Route::GET('/master/wisata', 'MasterController@wisataindex')->name('masterwi.index');
Route::POST('/master/wisata/store', 'MasterController@wisatastore')->name('masterwi.store');
Route::GET('master/wisata/edit/{poss_id}','MasterController@wisataedit')->name('masterwi.edit');
Route::PUT('master/wisata/{poss_id}','MasterController@wisataupdate')->name('masterwi.update');
Route::DELETE('master/wisata/{poss_id}/destroy','MasterController@wisatadestroy')->name('masterwi.destroy');

//Master Data SA
Route::GET('/master/asisten', 'MasterController@asistenindex')->name('masteras.index');
Route::POST('/master/asisten/store', 'MasterController@asistenstore')->name('masteras.store');
Route::GET('master/asisten/edit/{poss_id}','MasterController@asistenedit')->name('masteras.edit');
Route::PUT('master/asisten/{poss_id}','MasterController@asistenupdate')->name('masteras.update');
Route::DELETE('master/asisten/{poss_id}/destroy','MasterController@asistendestroy')->name('masteras.destroy');


Route::resource('selfie', 'SelfieController');
Route::resource('fasilitas', 'FasilitasController');

});
