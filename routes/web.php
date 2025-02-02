<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\Transaction_TypeController;
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

Route::get('/Transactiontypes', [Transaction_TypeController::class, 'index'])->name('Transactiontype');
Route::get('/TransactiontypesInsert', [Transaction_TypeController::class, 'insert'])->name('TransactiontypeInsert');
Route::post('/TransactiontypesStore', [Transaction_TypeController::class, 'Store']);
Route::get('/Transactiontypesedit/{id}', [Transaction_TypeController::class, 'edit']);
Route::post('/Transactiontypesupdate/{id}', [Transaction_TypeController::class, 'update']);
Route::get('/Transactiontypesdelete/{id}', [Transaction_TypeController::class, 'delete']);