<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/employees', [App\Http\Controllers\HomeController::class, 'employeesScreen'])->name('employees');
Route::get('/tasks', [App\Http\Controllers\HomeController::class, 'tasksScreen'])->name('tasks');
Route::any('/addEmployee/{param?}', [App\Http\Controllers\HomeController::class, 'manageEmployee'])->name('addEmployee');
Route::any('/addTask/{param?}', [App\Http\Controllers\HomeController::class, 'manageTask'])->name('addTask');
Route::any('/assignTask/{param?}', [App\Http\Controllers\HomeController::class, 'assignTasks'])->name('assignTask');
Route::any('/changeTaskStatus/{param?}', [App\Http\Controllers\HomeController::class, 'changeTaskStatus']);
Route::any('/doneTaskStatus/{param?}', [App\Http\Controllers\HomeController::class, 'doneTaskStatus']);
Route::any('/sendMail', [App\Http\Controllers\HomeController::class, 'sendMail']);
// Route::any('/exportCsvData', [App\Http\Controllers\HomeController::class, 'exportCsvData']);


// ----Tables-----


Route::get('/getEmployees', [App\Http\Controllers\tableController::class, 'getEmployeesData'])->name('getEmployees');
Route::get('/getTasks', [App\Http\Controllers\tableController::class, 'getTasksData'])->name('getTasks');


// ----Delete-----


Route::any('/deleteEmployee', [App\Http\Controllers\HomeController::class, 'deleteEmployeeData'])->name('deleteEmployee');
Route::any('/deleteTask', [App\Http\Controllers\HomeController::class, 'deleteTaskData'])->name('deleteTask');
