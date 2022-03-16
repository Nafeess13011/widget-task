<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController as Task;

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

Route::get('/',[Task::class,'index']);
Route::get('/index',[Task::class,'index']);
Route::post('/processorder',[Task::class,'processOrder']);
Route::get('pack/add',[Task::class,'add_pack']);
Route::post('pack_add_process',[Task::class,'pack_add_process'])->name('pack.insert');
Route::get('pack/delete/{id}',[Task::class,'delete']);
   Route::get('pack/add/{id}',[Task::class,'add_pack']);
   Route::get('openprocessorder',[Task::class,'openprocessorder']);
   Route::get('processorder',[Task::class,'processOrder']);