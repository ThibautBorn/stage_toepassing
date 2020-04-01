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

Route::get('/internform2',function () {
    return view('internForm');
});

//Company routes
Route::post('/company','CompanyController@store')->name('company');
Route::get('/view_company', 'CompanyController@view_company')->name('view_company');
Route::post('/edit_company', 'CompanyController@edit_company')->name('edit_company');
Route::put('/update_company', 'CompanyController@update_company')->name('update_company');
Route::delete('/company', 'CompanyController@delete_company')->name('delete_company');
Route::get('/form', 'CompanyController@create')->name('company_form');

// iternships routes
Route::post('/internship','InternshipController@store')->name('internship');
Route::get('/view_internship', 'InternshipController@view_internship')->name('view_internship');
Route::post('/edit_internship', 'InternshipController@edit_internship')->name('edit_internship');
Route::get('/edit_internship', 'InternshipController@edit_internship')->name('edit_internship');
Route::put('/update_internship', 'InternshipController@update_internship')->name('update_internship');
Route::delete('/internship', 'InternshipController@delete_internship')->name('delete_internship');
Route::get('/internform','InternshipController@create_internship')->name('internform');

//dynamic
Route::get('dropdownlist/getoptions/{id}','InternshipController@getOptions');

//submision routes
Route::post('/edit_submission','SubmissionController@edit_submission')->name('edit_submission');
Route::get('/submission_overview','SubmissionController@review_submission');
Route::get('/confirmation','SubmissionController@finalize_submission')->name('confirmation');


//admin-logged in routes
Auth::routes(['register' => false]); //kan wel gebruikt worden /login
//Auth::routes();
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/all_overview', 'HomeController@list_all')->name('list_all')->middleware('auth');
Route::get('/companies_overview', 'HomeController@list_companies')->name('list_companies')->middleware('auth');
Route::get('/add_internship', 'internshipController@set_company')->name('add_to_company')->middleware('auth');
Route::get('/export_internships', 'HomeController@export')->name('export')->middleware('auth');


