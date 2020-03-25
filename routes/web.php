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

Route::get('/','EfilingController@index')->name('index');


Route::get('/CopyToBackUp', 'EfilingController@CopyToBackUp')->name('CopyToBackUp');
Route::get('/MoveBackUpFolder', 'EfilingController@MoveBackUpFolder')->name('MoveBackUpFolder');
Route::get('/MoveBackUpFile', 'EfilingController@MoveBackUpFile')->name('MoveBackUpFile');

Route::get('/CreateStagingDirectory', 'EfilingController@CreateStagingDirectory')->name('CreateStagingDirectory');
Route::post('/PostCreateStagingDirectory', 'EfilingController@PostCreateStagingDirectory')->name('PostCreateStagingDirectory');

Route::get('/DeleteStagingDirectory', 'EfilingController@DeleteStagingDirectory')->name('DeleteStagingDirectory');
Route::get('DeleteStagingFiles/', 'EfilingController@DeleteStagingFiles')->name('DeleteStagingFiles');

Route::get('/GetStagingDirectories', 'EfilingController@GetStagingDirectories')->name('GetStagingDirectories');
Route::get('/GetStagingFiles/{pin}', 'EfilingController@GetStagingFiles')->name('GetStagingFiles');

Route::get('/GetFiles', 'EfilingController@GetFiles')->name('GetFiles');

Route::get('/GetFiles/{pin}', 'EfilingController@GetFiles')->name('GetFiles');
