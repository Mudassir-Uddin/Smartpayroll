<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/Admindashboard', [DashboardController::class, 'Admindashboard'])->name('Admindashboard');


// DB User

Route::get('/DbUsers', [UsersController::class, 'Users'])->name('DbUser');
Route::get('/UsersInsert', [UsersController::class, 'insert'])->name('UserInsert');
Route::post('/UsersStore', [UsersController::class, 'Store']);
Route::get('/Usersedit/{id}', [UsersController::class, 'edit']);
Route::post('/Usersupdate/{id}', [UsersController::class, 'update']);
Route::get('/Usersdelete/{id}', [UsersController::class, 'delete']);

Route::get('/Departments', [DepartmentsController::class, 'index'])->name('Department');
Route::get('/DepartmentsInsert', [DepartmentsController::class, 'insert'])->name('DepartmentInsert');
Route::post('/DepartmentsStore', [DepartmentsController::class, 'Store']);
Route::get('/Departmentsedit/{id}', [DepartmentsController::class, 'edit']);
Route::post('/Departmentsupdate/{id}', [DepartmentsController::class, 'update']);
Route::get('/Departmentsdelete/{id}', [DepartmentsController::class, 'delete']);