<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\essayController;
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
Route::post('checkAdd',[essayController::class, 'addessay'])->name("addSermina");
Route::get('/', [essayController::class, 'loadData'])->name("home");
Route::get('checkDelete/{id}',[essayController::class, 'deleteessay'])->name("deleteessay");
Route::post('deleteAll',[essayController::class, 'deleteAllessay']);
Route::get('EditSer/{id}',[essayController::class, 'editessay'])->name("editessay");
Route::post('updateSer/{id}',[essayController::class, 'updateessay'])->name("updateessay");
Route::get('/search',[essayController::class, 'searchessay'])->name("search");
Route::get('/filter',[essayController::class, 'filteressay'])->name("filter");