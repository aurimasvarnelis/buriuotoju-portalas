<?php

use Illuminate\Support\Facades\Route;
//use Illuminate\Support\Facades\Gate;
//use App\Providers\AuthServiceProvider;



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
Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('profile', function () {
    // Only verified users may enter...
})->middleware('verified');

//User
Route::get('/home', [App\Http\Controllers\UserController::class, 'index'])->middleware('verified')->name('home');

Route::get('/inform', [App\Http\Controllers\UserController::class, 'inform'])->middleware('can:user')->middleware('verified')->name('inform');
Route::post('/inform', [App\Http\Controllers\UserController::class, 'informForecast'])->middleware('can:user')->middleware('verified')->name('informForecast');
Route::get('/report', [App\Http\Controllers\UserController::class, 'report'])->middleware('can:user')->middleware('verified')->name('report');
Route::post('/report', [App\Http\Controllers\UserController::class, 'reportSubmit'])->middleware('can:user')->middleware('verified')->name('report');

//Moderator
Route::get('/loadforecast', [App\Http\Controllers\ModeratorController::class, 'loadForecastSettingsView'])->middleware('can:moderator')->name('loadForecast');
Route::post('/loadforecast', [App\Http\Controllers\ModeratorController::class, 'loadForecastData'])->middleware('can:moderator')->name('loadForecastData');

//Admin
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->middleware('can:admin')->name('admin.index');
Route::get('/admin/create', [App\Http\Controllers\AdminController::class, 'create'])->middleware('can:admin')->name('admin.create');
Route::post('/admin/create', [App\Http\Controllers\AdminController::class, 'createUpdate'])->middleware('can:admin')->name('admin.createUpdate');
Route::get('/admin/{user}', [App\Http\Controllers\AdminController::class, 'edit'])->middleware('can:admin')->name('admin.edit');
Route::post('/admin/{user}', [App\Http\Controllers\AdminController::class, 'update'])->middleware('can:admin')->name('admin.update');

Route::delete('/admin/{user}', [App\Http\Controllers\AdminController::class, 'delete'])->middleware('can:admin')->name('admin.delete');


/*Route::get('send-mail', function () {
   
    $details = [
        'title' => 'Mail from ItSolutionStuff.com',
        'body' => 'This is for testing email using smtp'
    ];
   
    \Mail::to('your_receiver_email@gmail.com')->send(new \App\Mail\Forecast($details));
   
    dd("Email is Sent.");
});*/


//Route::get('/mail', [App\Http\Controllers\UserController::class, 'sendMail']);

//Route::get('/user/{user}/specific', 'ReportController@specific')->middleware('can:view_users')->name('report.specific');