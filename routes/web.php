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

setlocale(LC_TIME, 'ms_MY.utf8', 'Malay_malaysia.1252', 'Malaysian');

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/programme/scan/{qr}', 'ScanController@index')->name('programme.scan');
Route::get('/programme/get/document/{path}', 'ProgrammeController@getDocuments')->name('programme.get.document');
Route::get('/gallery/photos/{path}', 'GalleryController@getPhoto')->name('gallery.photo');


Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', 'UserController', ['except' => ['show']]);

    Route::put('/user/password/{id}', 'UserController@password')->name('user.password');

    //Profile Routes
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::get('/profile/image/{filename}', ['as' => 'profile.image', 'uses' => 'ProfileController@getProfileImage']);
    Route::post('/profile/upload', 'ProfileController@upload')->name('profile.upload');
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

    //Program Routes
    Route::get('programme/index', 'ProgrammeController@index')->name('programme');
    Route::post('programme/index', 'ProgrammeController@index')->name('programme.filter');
    Route::get('/programme/create','ProgrammeController@create')->name('programme.create');
    Route::get('/programme/edit/{id}','ProgrammeController@edit')->name('programme.edit');
    Route::put('/programme/update/{id}','ProgrammeController@update')->name('programme.update');
    Route::delete('/programme/destroy/{id}','ProgrammeController@destroy')->name('programme.destroy');
    Route::post('/programme/document/{id}','ProgrammeController@document')->name('programme.document');
    Route::put('/programme/submit/{id}','ProgrammeController@submit')->name('programme.submit');
    Route::put('/programme/approve/{id}','ProgrammeController@approve')->name('programme.approve');
    Route::post('/programme/store', 'ProgrammeController@store')->name('programme.store');
    Route::get('/programme/show/{id}', 'ProgrammeController@show')->name('programme.show');
    Route::get('/programme/print/{id}/{type}', 'ProgrammeController@print')->name('programme.print');
    Route::get('/programme/preview/{id}/{type}/', 'ProgrammeController@preview')->name('programme.preview');
    Route::delete('programme/{id}/document/delete/{path}', 'ProgrammeController@destroyDocuments')->name('document.destroy');


    //Template Routes
    Route::get('template/index', 'TemplateController@index')->name('template');
    Route::get('/template/orientation', 'TemplateController@orientation')->name('template.orientation');
    Route::get('/template/create', 'TemplateController@create')->name('template.create');
    Route::post('/template/upload', 'TemplateController@upload')->name('template.upload');
    Route::get('/template/edit/{id}', 'TemplateController@edit')->name('template.edit');
    Route::delete('/template/destroy/{id}', 'TemplateController@destroy')->name('template.delete');
    Route::post('/template/update/{id}', 'TemplateController@update')->name('template.update');
    Route::get('/template/preview/{id}', 'TemplateController@preview')->name('template.preview');


    //Candidate Routes

    Route::get('/programme/{id}/candidate/{type}/create',['as' => 'candidate.create', 'uses' => 'CandidateController@create']);
    Route::post('/programme/{id}/candidate/{type}/store',['as' => 'candidate.store', 'uses' => 'CandidateController@store']);
    Route::post('/programme/{id}/candidate/{type}/upload',['as' => 'candidate.upload', 'uses' => 'CandidateController@importExcel']);
    Route::get('/candidate/edit/{id}/type/{type}', 'CandidateController@edit')->name('candidate.edit');
    Route::put('/candidate/update/{id}', 'CandidateController@update')->name('candidate.update');
    Route::delete('/programme/{programme}/candidate/destroy/{candidate}', 'CandidateController@destroy')->name('candidate.destroy');

    //Gallery Routes
    Route::get('/programme/{id}/gallery/', 'ProgrammeController@gallery')->name('programme.gallery');
    Route::post('/programme/{id}/gallery/store', 'GalleryController@store')->name('gallery.store');
    Route::delete('programme/{id}/gallery/destroy', 'GalleryController@destroy')->name('gallery.destroy');

    //Font Routes
    Route::get('fonts/index', 'FontController@index')->name('font');
    Route::post('fonts/store', 'FontController@store')->name('font.store');
    Route::get('{path}', 'FontController@show')->name('font.show');
    Route::delete('fonts/{path}', 'FontController@destroy')->name('font.destroy');
    Route::get('fonts/{id}', 'FontController@edit')->name('font.edit');

    Route::get('/home/chart','HomeController@chart')->name('chart');




});



