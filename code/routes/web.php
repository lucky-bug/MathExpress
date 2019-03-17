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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


/*
 * The routes below is only for design testing purpose and should removed later
 */


Route::resource('/docs', 'DocController');
Route::get('/docs/{doc}/download', 'DocController@download')->name('doc.download');

Route::resource('/terms', 'TermController');
Route::get('/terms/{letter}', 'TermController@searchByLetter')->name('terms.searchByLetter');

Route::resource('/questions','QuestionController');
Route::resource('/modules', 'ModuleController');
Route::resource('/answers', 'AnswerController');