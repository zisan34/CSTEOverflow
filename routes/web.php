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
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/onlineExam','FrontendController@onlineExam')->name('onlineExam');

Route::get('/onlineExam/create','QuizesController@create')->name('onlineExam.create');

Route::post('/onlineExam/create/quiz', 'QuizesController@createQuiz')->name('onlineExam.create.quiz');

Route::post('/onlineExam/create/questionanswer', 'QuizesController@questionAnswer')->name('onlineExam.create.questionAnswer');

Route::get('/onlineExam/create/setQuestionAnswer/{q_id}', 'QuizesController@setQuestionAnswer')->name('onlineExam.create.setQuestionAnswer');

Route::get('/onlineExam/view/{id}','QuizesController@view')->name('onlineExam.view');

Route::get('/onlineExam/participate','QuizesController@participate')->name('onlineExam.participate');

Route::post('/onlineExam/participate/quiz_info','QuizesController@quiz_info')->name('onlineExam.quiz_info');

Route::post('/onlineExam/participate/start','QuizesController@start')->name('onlineExam.start');

Route::post('/onlineExam/participate/quiz/submit','QuizesController@submit')->name('onlineExam.submit');