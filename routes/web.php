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
    return redirect()->route('login');
});
Auth::routes(['register' => false]);

Auth::routes();

Route::middleware(['auth'])->group(function(){
    //home
    Route::get('/home', 'HomeController@index')->name('home');

    //Report
    Route::resource('report', 'ReportController');
    Route::view('tech_report','pages.technical_reports')->name('tech_report');
    Route::get('cancel_report/{id}', 'ReportController@cancel')->name('cancel_report');
    Route::get('done_report/{id}', 'ReportController@done')->name('done_report');
    Route::view('canceled', 'pages.canceled');
    Route::view('done', 'pages.done');
    Route::get('retrieve/{id}', 'ReportController@retrieve_canceled')->name('retrieve');
    Route::get('rework/{id}', 'ReportController@reWork')->name('rework');


    Route::resource('departments','DepartmentController');

    Route::prefix('admin')->group(function () {
        Route::view('department', 'pages.admin-department');
        Route::get('edit_department/{id}/edit', 'DepartmentController@edit');
        Route::delete('department/delete/{id}', 'DepartmentController@destroy');
        Route::put('department/{id}', 'DepartmentController@update');
        
    });

});