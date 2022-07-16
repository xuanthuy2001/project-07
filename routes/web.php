<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GroupsController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



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
        Route::post('/add', [GroupsController::class, 'postAdd']);
        Route::get('/edit/{group}', [GroupsController::class, 'edit'])->name('edit');
        Route::post('/edit/{group}', [GroupsController::class, 'postEdit']);
        Route::delete('/delete/{group}', [GroupsController::class, 'delete'])->name('delete');
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
        Route::post('/add', [UsersController::class, 'postAdd']);

        Route::get('/edit/{user}', [UsersController::class, 'edit'])->name('edit');

        Route::post('/edit/{user}', [UsersController::class, 'postEdit']);

        // Route::delete('/delete/{user}', [UsersController::class, 'delete'])->name('delete');


        Route::delete('/delete/{user}', [UsersController::class, 'delete'])->name('delete');
    });
});