<?php

use App\Http\Controllers\TaskOneController;
use App\Http\Controllers\TaskTwoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () { return view('Index'); });
Route::prefix('task_one/')->group(function () {
    Route::get('', [TaskOneController::class, 'index']);
    Route::post('add', [TaskOneController::class, 'add']);
    Route::get('edit/{id}', [TaskOneController::class, 'edit']);
    Route::post('update', [TaskOneController::class, 'update']);
    Route::get('delete/{id}', [TaskOneController::class, 'delete']);
    Route::get('final_submit', [TaskOneController::class, 'final_submit']);
});

Route::prefix('task_two/')->group(function () {
    Route::get('', [TaskTwoController::class, 'index']);
    Route::post('add_coloumn', [TaskTwoController::class, 'add_coloumn']);
    Route::post('update', [TaskTwoController::class, 'update']);
});
