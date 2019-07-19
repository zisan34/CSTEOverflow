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

Route::get('/', 'FrontendController@welcome');

Route::group(['prefix'=>'file'],function(){
	Route::get('/','FilesController@index')->name('files');
	Route::post('/save','FilesController@save')->name('file.save')->middleware('auth');

});


Route::group(['prefix' => 'admin', 'middleware'=>'admin'], function() {

	Route::get('/dashboard','BackendController@index')->name('dashboard');


	Route::get('/courses','BackendController@courses')->name('courses');
	Route::post('/add/course','BackendController@addCourse')->name('add.course');
	Route::get('/delete/course/{id}','BackendController@deleteCourse')->name('delete.course');


	Route::get('/tags','BackendController@tags')->name('tags');
	Route::post('/add/tag','BackendController@addTag')->name('add.tag');
	Route::get('/delete/tag/{id}','BackendController@deleteTag')->name('delete.tag');




	Route::name('admin.')->group(function () {

	Route::get('/posts','BackendController@posts')->name('posts');
	Route::get('/delete/post/{id}','BackendController@deletePost')->name('delete.post');
	Route::get('/posts/trashed','BackendController@trashedPosts')->name('posts.trashed');
	Route::get('/destroy/post/{id}','BackendController@destroyPost')->name('destroy.post');
	Route::get('/restore/post/{id}','BackendController@restorePost')->name('restore.post');


	Route::get('/files','BackendController@files')->name('files');
	Route::get('/delete/file/{id}','BackendController@deleteFile')->name('delete.file');


	Route::get('/notices','BackendController@notices')->name('notices');
	Route::get('/delete/notice/{id}','BackendController@deleteNotice')->name('delete.notice');


	});







	Route::get('/users','BackendController@users')->name('users');
	Route::get('/user/enable/{id}','BackendController@enableUser')->name('user.enable');
	Route::get('/user/disable/{id}','BackendController@disableUser')->name('user.disable');
	Route::get('/user/delete/{id}','BackendController@deleteUser')->name('user.delete');





});

Route::group(['prefix'=>'notice'],function(){
	Route::get('/','NoticesController@index')->name('notice');	
	Route::get('/create','NoticesController@create')->name('notice.create')->middleware('auth');
	Route::post('/save','NoticesController@save')->name('notice.save')->middleware('auth');
	Route::get('/view/{id}','NoticesController@view')->name('notice.view');
	Route::get('/show/{path}','NoticesController@show')->name('notice.show');

});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix'=>'post'],function(){

	Route::post('/save','PostsController@save')->name('post.save')->middleware('auth');
	Route::get('/view/{enc_id}','PostsController@viewPost')->name('post.view');
	Route::get('/filter/tag/{id}','PostsController@filter')->name('posts.filter.tag');


	Route::post('/comment/{post_id}','PostsController@comment')->name('post.comment')->middleware('auth');

});




Route::group(['prefix' => 'onlineExam', 'middleware'=>'auth'], function() {

	Route::get('/','FrontendController@onlineExam')->name('onlineExam');

	Route::get('/create','QuizesController@create')->name('onlineExam.create');
	Route::get('/edit/{id}','QuizesController@editQuiz')->name('onlineExam.edit');
	Route::get('/enable/{id}','QuizesController@enable')->name('onlineExam.enable');
	Route::get('/disable/{id}','QuizesController@disable')->name('onlineExam.disable');
	Route::post('/update','QuizesController@updateQuiz')->name('onlineExam.update');
	Route::post('/create/quiz', 'QuizesController@createQuiz')->name('onlineExam.create.quiz');

	Route::post('/create/questionanswer', 'QuizesController@storeQuestionAnswer')->name('onlineExam.create.questionAnswer');
	Route::get('/create/setQuestionAnswer/{q_id}', 'QuizesController@setQuestionAnswer')->name('onlineExam.create.setQuestionAnswer');

	Route::get('/view/{id}','QuizesController@view')->name('onlineExam.view');


	Route::get('/participants/{id}','QuizesController@quizParticipations')->name('onlineExam.participations');
	Route::get('/participation/manualcheck/{id}','QuizesController@manualCheckParticipation')->name('onlineExam.participation.manual');
	Route::get('/participation/manualcheck/updateresult/{id}/{status}','QuizesController@updateFigResult')->name('onlineExam.participation.updateFIGresult');
	Route::post('/participation/manualcheck/updateresult','QuizesController@updateSqResult')->name('onlineExam.participation.updateSQresult');



	Route::get('/edit/editQuestionAnswer/{q_id}','QuizesController@editQA')->name('onlineExam.edit.QA');
	Route::post('/edit/updateQuestionAnswer','QuizesController@updateQA')->name('onlineExam.update.QA');




	Route::get('/participate','QuizesController@participate')->name('onlineExam.participate');
	Route::post('/participate/quiz_info','QuizesController@quiz_info')->name('onlineExam.quiz_info');
	Route::post('/participate/start','QuizesController@quizStart')->name('onlineExam.start');
	Route::get('/participate/start/{quiz_id}','QuizesController@startQuiz')->name('onlineExam.quiz.start');
	Route::post('/participate/quiz/submit','QuizesController@quizSubmit')->name('onlineExam.submit');
	Route::get('/showResult/{quiz_participation_id}','QuizesController@showResult')->name('onlineExam.result');

});


