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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/teams', );

Route::get('teams/:id', );

Route::post('/teams/:id/member', );

Route::delete('/teams/:id/members/:id2', );

Route::post('/teams/:id/tasks', );

Route::get('/teams/:id/tasks/:id2', );

Route::patch('/teams/:id/tasks/:id2', );

Route::get('/teams/:id/tasks/', );

Route::get('/teams/:id/members/:id2/tasks/', );
