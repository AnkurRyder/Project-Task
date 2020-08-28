<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/teams', 'TeamController@CreateTeam');

Route::get('teams/{id}', 'TeamController@Show');

Route::post('/teams/{id}/member', 'MemberController@CreateMember');

Route::delete('/teams/{id1}/members/{id2}', 'MemberController@DeleteMember');

Route::post('/teams/{id1}/tasks', 'TaskController@CreateTask');

Route::get('/teams/{id1}/tasks/{id2}', 'TaskController@ShowTask');

Route::patch('/teams/{id1}/tasks/{id2}', 'TaskController@UpdateTask');

Route::get('/teams/{id1}/tasks/', 'TaskController@ShowTasks');

Route::get('/teams/{id1}/members/{id2}/tasks/', 'TaskController@ShowMemberTasks');
