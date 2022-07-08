<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GroupsController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\UsersController;
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


Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    // group
    Route::prefix('groups')->name('groups.')->group(function () {
        Route::get('/', [GroupsController::class, 'index'])->name('index');
        Route::get('/add', [GroupsController::class, 'add'])->name('add');
    });

    // post
    Route::prefix('posts')->name('posts.')->group(function () {
        Route::get('/', [PostsController::class, 'index'])->name('index');
        Route::get('/add', [PostsController::class, 'add'])->name('add');
    });

    // user
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('index');

        Route::get('/add', [UsersController::class, 'add'])->name('add');

        Route::get('/edit/{user}', [UsersController::class, 'edit'])->name('edit');

        Route::post('/edit/{user}', [UsersController::class, 'postEdit']);

        Route::post('/delete/{user}', [UsersController::class, 'delete'])->name('delete');
    });
});