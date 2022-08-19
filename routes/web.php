<?php
namespace App\Http\Controllers;
use App\Models\User;
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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/register',[UserController::class,'register'])->name('register');

Route::get('/login',[UserController::class,'login'])->name('login');

Route::post('/register',[UserController::class,'register_action'])->name('register.action');

Route::post('/login',[UserController::class,'login_action'])->name('login.action');

Route::get('/users/index',[UserController::class,'index'])->name('user.index');

Route::get('users/update/{id}',[UserController::class,'edit']);
Route::post('users/update/{id}',[UserController::class,'update']);

Route::get('users/delete/{id}',[UserController::class,'delete']);

Route::resource('categories',CategoryController::class)->except(['show','create','store']);

Route::resource('posts',PostController::class)->except(['show','create','edit']);
