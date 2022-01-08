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

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MotionController;
use App\Http\Controllers\ResultViewController;
use App\Http\Controllers\ImageController;




Route::get('/',             [LoginController::class, 'login']);
Route::post('/signin',      [LoginController::class, 'signin']);

Route::get('/menu',function(){
    return view('menu');
});

Route::get('/menu2',function(){
    return view('menu2');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/waitmotion',      [MotionController::class, 'wait']);

Route::post('/get_motion',      [MotionController::class, 'motion']);

Route::get('/upload_image',      [ImageController::class, 'motion_wait']);

Route::post('/upload_image',      [ImageController::class, 'motion_wait']);

Route::get('/motionOK', function () {
    return view('motionOK');
});

Route::get('/motionNO', function () {
    return view('motionNO');
});

Route::get('/result',      [ResultViewController::class, 'resultshow']);


Route::get('/receive', function () {
    return view('switching_OK_receive');
});

Route::get('/send', function () {
    return view('switching_OK_send');
});