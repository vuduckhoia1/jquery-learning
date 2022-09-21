<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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


Route::get('/', [PostController::class, 'index'])->name('home')->middleware('auth')->middleware(['auth', 'verified']);



Route::get('/register', [UserController::class, 'register'])->name('register');

Route::get('/login', [UserController::class, 'login'])->name('login');

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::post('/register', [UserController::class, 'register_action'])->name('register.action');

Route::post('/login', [UserController::class, 'login_action'])->name('login.action');


Route::get('users/update/{id}', [UserController::class, 'edit'])->middleware('auth');
Route::post('users/update/{id}', [UserController::class, 'update']);

Route::get('users/delete/{id}', [UserController::class, 'delete'])->middleware('auth');

Route::resource('categories', CategoryController::class)->except(['show', 'create', 'store'])->middleware('auth');

Route::resource('posts', PostController::class)->except(['show', 'create', 'edit'])->middleware('auth');

Route::get('/email/verify', function () {
    $data['title'] = 'Mail notification';
    return view('user.mailer', $data);
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect(\route('home'));
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/ajax/posts', function () {
    $posts = Post::paginate(2);
    return view('posts.pagination', ['posts' => $posts]);
});



Route::get('/ajax/users', function () {
    $users = User::paginate(2);
    return view('user.pagination', ['users' => $users]);
});

Route::get('/auto-complete-search-query', [PostController::class, 'query'])->name('autocomplete.search.query');

Route::get('/admin/login', function () {
    return view('admin/login/login');
});
Route::post('/admin/login', [UserController::class, 'login_action_admin'])->name('login.action.admin');

Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');


Route::get('/admin/index', [UserController::class, 'index'])->name('admin.index');

Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
Route::post('/admin/users/create', [UserController::class, 'store'])->name('admin.users.store');

Route::post('/admin/skills/create', [SkillController::class, 'store'])->name('admin.skills.store');
Route::get('/admin/users/edit/{id}', [UserController::class, 'admin_edit'])->name('admin.users.edit');
Route::put('/admin/users/edit/{id}', [UserController::class, 'admin_update'])->name('admin.users.update');
