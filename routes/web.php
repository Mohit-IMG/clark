<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\ProjectController;


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


	Route::get('/', "HomeController@index");

//contact submit

Route::post('/add', "HomeController@add")->name('add');

	Route::get('get-state', "AboutController@getState");
	Route::get('get-city', "HomeController@getCity"); 

	Route::get('login', 'Auth\LoginController@showLoginForm');
	Route::post('login', 'Auth\LoginController@login')->name('login'); 

	Route::match(['get','post'],'/change-password', 'Admin\AdminController@changePassword')->name('changepassword');
 
	Route::group(['prefix'=>'admin','as'=>'admin','middleware'=>['auth','checkadmin'],'as'=>'admin.'],function() {
		
		Route::match(['get','post'],'/logout','Auth\LoginController@logout')->name('logout');
		Route::match(['get','post'],'/dashboard', 'Admin\DashboardController@index');
 
				//about
					Route::group(['prefix'=>'about'],function() {
					Route::match(['get','post'],'add', 'Admin\AboutController@add')->name('about.add');
					Route::get('list', 'Admin\AboutController@aboutList');
					route::post('change-status','Admin\AboutController@changestatus')->name('about.changestatus');
					Route::get('update/{id}','Admin\AboutController@update');
					Route::get('delete/{id}','Admin\AboutController@destroy');
					Route::post('change-order','Admin\AboutController@changeorder')->name('about.change-order'); 
					Route::get('get-state', "AboutController@getState");
					Route::get('get-city', "HomeController@getCity"); 
				});

				//slider
					Route::group(['prefix'=>'slider'],function() {
					Route::match(['get','post'],'add', 'Admin\SliderController@add')->name('slider.add');
					Route::get('list', 'Admin\SliderController@sliderList');
					route::post('change-status','Admin\SliderController@changestatus')->name('slider.changestatus');
					Route::get('update/{id}','Admin\SliderController@update');
					Route::get('delete/{id}','Admin\SliderController@destroy');
					Route::post('change-order','Admin\SliderController@changeorder')->name('slider.change-order'); 
				});


				//resumes
					Route::group(['prefix'=>'resume'],function() {
					Route::match(['get','post'],'add', 'Admin\ResumeController@add')->name('resume.add');
					Route::get('list', 'Admin\ResumeController@resumeList');
					route::post('change-status','Admin\ResumeController@changestatus')->name('resume.changestatus');
					Route::get('update/{id}','Admin\ResumeController@update');
					Route::get('delete/{id}','Admin\ResumeController@destroy');
				});

			//services
				Route::group(['prefix'=>'service'],function() {
				Route::match(['get','post'],'add', 'Admin\ServiceController@add')->name('service.add');
				Route::get('list', 'Admin\ServiceController@serviceList');
				route::post('change-status','Admin\ServiceController@changestatus')->name('service.changestatus');
				Route::get('update/{id}','Admin\ServiceController@update');
				Route::get('delete/{id}','Admin\ServiceController@destroy');
			});

						//skills
				Route::group(['prefix'=>'skills'],function() {
				Route::match(['get','post'],'add', 'Admin\SkillController@add')->name('skills.add');
				Route::get('list', 'Admin\SkillController@skillList');
				route::post('change-status','Admin\SkillController@changestatus')->name('skills.changestatus');
				Route::get('update/{id}','Admin\SkillController@update');
				Route::get('delete/{id}','Admin\SkillController@destroy');
			});

			//project
			Route::group(['prefix'=>'project'],function() {
				Route::match(['get','post'],'add', 'Admin\ProjectController@add')->name('project.add');
				Route::get('list', 'Admin\ProjectController@projectList');
				route::post('change-status','Admin\ProjectController@changestatus')->name('project.changestatus');
				Route::get('update/{id}','Admin\ProjectController@update');
				Route::get('delete/{id}','Admin\ProjectController@destroy');
			});
			
			Route::match(['get','post'],'contact', 'Admin\ProjectController@contactList')->name('contact');
				

		
});


	Route::match(['get','post'],'/logout','Auth\LoginController@logout')->name('logout');
