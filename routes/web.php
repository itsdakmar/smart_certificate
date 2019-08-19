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
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

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
    Route::get('/programme/index', 'ProgrammeController@index')->name('programme');
    Route::post('/programme/index', 'ProgrammeController@index')->name('programme.filter');
    Route::get('/programme/create','ProgrammeController@create')->name('programme.create');
    Route::get('/programme/edit/{id}','ProgrammeController@edit')->name('programme.edit');
    Route::put('/programme/update/{id}','ProgrammeController@update')->name('programme.update');
    Route::put('/programme/submit/{id}','ProgrammeController@submit')->name('programme.submit');
    Route::put('/programme/approve/{id}','ProgrammeController@approve')->name('programme.approve');
    Route::post('/programme/store', 'ProgrammeController@store')->name('programme.store');
    Route::get('/programme/show/{id}', 'ProgrammeController@show')->name('programme.show');
    Route::get('/programme/print/{id}/{type}', 'ProgrammeController@print')->name('programme.print');
    Route::get('/programme/preview/{id}/{type}/', 'ProgrammeController@preview')->name('programme.preview');
    Route::get('/programme/scan/{qrcode}', 'ProgrammeController@scan')->name('programme.scan');

    //Template Routes
    Route::get('/template/index', 'TemplateController@index')->name('template');
    Route::get('/template/orientation', 'TemplateController@orientation')->name('template.orientation');
    Route::get('/template/create', 'TemplateController@create')->name('template.create');
    Route::post('/template/upload', 'TemplateController@upload')->name('template.upload');
    Route::get('/template/edit/{id}', 'TemplateController@edit')->name('template.edit');
    Route::post('/template/update/{id}', 'TemplateController@update')->name('template.update');
    Route::get('/template/preview/{id}', 'TemplateController@preview')->name('template.preview');


    //Candidate Routes
    Route::get('/programme/{id}/candidate/create',['as' => 'candidate.create', 'uses' => 'CandidateController@create']);
    Route::post('/programme/{id}/candidate/store',['as' => 'candidate.store', 'uses' => 'CandidateController@store']);
    Route::post('/programme/{id}/candidate/upload',['as' => 'candidate.upload', 'uses' => 'CandidateController@importExcel']);
    Route::get('/candidate/edit/{id}', 'CandidateController@edit')->name('candidate.edit');
    Route::put('/candidate/update/{id}', 'CandidateController@update')->name('candidate.update');


});



