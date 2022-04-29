<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ImapController;

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
Route::get('index',function(){
      return view('index');
})->name('index');



Route::get('indexui',function(){
    return view('indexui');
})->name('indexui');

// Route::get('mailbox',function(){

//     return view('mailbox');
// })->name('mailbox');

Route::get('compose',function(){
    return view('compose');
})->name('compose');


Route::get('read-mail',function(){
    return view('read-mail');
})->name('read-mail');

Route::post('sendEmail',[EmailController::class,'sendMail'])->name('sendEmail');
// Route::get('getEmail',[ImapController::class,'getEmail'])->name('getEmail');
Route::get('mailbox',[ImapController::class,'getEmail'])->name('mailbox');
 Route::get('readMail',[ImapController::class,'readMail'])->name('readMail');

