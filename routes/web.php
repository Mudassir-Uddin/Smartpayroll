<?php

use App\Http\Controllers\AttendancesController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BonusesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeductionsController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\DesignationsController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\MonthsController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\SalariesController;
use App\Http\Controllers\Transaction_TypeController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/Admindashboard', [DashboardController::class, 'Admindashboard'])->name('Admindashboard');


// DB User

Route::get('/DbUsers', [UsersController::class, 'Users'])->name('DbUser')->middleware('Admin');
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

Route::get('/Employees', [EmployeesController::class, 'index'])->name('Employee');
Route::get('/EmployeesInsert', [EmployeesController::class, 'insert'])->name('EmployeeInsert');
Route::post('/EmployeesStore', [EmployeesController::class, 'Store']);
Route::get('/Employeesedit/{id}', [EmployeesController::class, 'edit']);
Route::post('/Employeesupdate/{id}', [EmployeesController::class, 'update']);
Route::get('/Employeesdelete/{id}', [EmployeesController::class, 'delete']);

Route::get('/getBasicSalary/{id}', [EmployeesController::class, 'getBasicSalary']);

Route::get('/Designations', [DesignationController::class, 'index'])->name('Designation');
Route::get('/DesignationsInsert', [DesignationController::class, 'insert'])->name('DesignationInsert');
Route::post('/DesignationsStore', [DesignationController::class, 'Store']);
Route::get('/Designationsedit/{id}', [DesignationController::class, 'edit']);
Route::post('/Designationsupdate/{id}', [DesignationController::class, 'update']);
Route::get('/Designationsdelete/{id}', [DesignationController::class, 'delete']);

Route::get('/Attendances', [AttendancesController::class, 'index'])->name('Attendance');
Route::get('/AttendancesInsert', [AttendancesController::class, 'insert'])->name('AttendanceInsert');
Route::post('/AttendancesStore', [AttendancesController::class, 'Store']);
Route::get('/Attendancesedit/{id}', [AttendancesController::class, 'edit']);
Route::post('/Attendancesupdate/{id}', [AttendancesController::class, 'update']);
Route::get('/Attendancesdelete/{id}', [AttendancesController::class, 'delete']);
Route::resource('attendance', AttendancesController::class);

Route::get('/Bonuses', [BonusesController::class, 'index'])->name('Bonuse');
Route::get('/BonusesInsert', [BonusesController::class, 'insert'])->name('BonuseInsert');
Route::post('/BonusesStore', [BonusesController::class, 'Store']);
Route::get('/Bonusesedit/{id}', [BonusesController::class, 'edit']);
Route::post('/Bonusesupdate/{id}', [BonusesController::class, 'update']);
Route::get('/Bonusesdelete/{id}', [BonusesController::class, 'delete']);

Route::get('/Deductions', [DeductionsController::class, 'index'])->name('Deduction');
Route::get('/DeductionsInsert', [DeductionsController::class, 'insert'])->name('DeductionsInsert');
Route::post('/DeductionsStore', [DeductionsController::class, 'Store']);
Route::get('/Deductionsedit/{id}', [DeductionsController::class, 'edit']);
Route::post('/Deductionsupdate/{id}', [DeductionsController::class, 'update']);
Route::get('/Deductionsdelete/{id}', [DeductionsController::class, 'delete']);

Route::get('/Months', [MonthsController::class, 'index'])->name('Month');
Route::get('/MonthsInsert', [MonthsController::class, 'insert'])->name('MonthInsert');
Route::post('/MonthsStore', [MonthsController::class, 'Store']);
Route::get('/Monthsedit/{id}', [MonthsController::class, 'edit']);
Route::post('/Monthsupdate/{id}', [MonthsController::class, 'update']);
Route::get('/Monthsdelete/{id}', [MonthsController::class, 'delete']);

Route::get('/Salaries', [SalariesController::class, 'index'])->name('Salary');
Route::get('/SalariesInsert', [SalariesController::class, 'insert'])->name('SalaryInsert');
Route::post('/SalariesStore', [SalariesController::class, 'Store']);
Route::get('/Salariesedit/{id}', [SalariesController::class, 'edit']);
Route::post('/Salariesupdate/{id}', [SalariesController::class, 'update']);
Route::get('/Salariesdelete/{id}', [SalariesController::class, 'delete']);

Route::get('/Payrolls', [PayrollController::class, 'index'])->name('Payroll');
Route::get('/PayrollsInsert', [PayrollController::class, 'insert'])->name('PayrollInsert');
Route::post('/PayrollsStore', [PayrollController::class, 'Store']);
Route::get('/Payrollsedit/{id}', [PayrollController::class, 'edit']);
Route::post('/Payrollsupdate/{id}', [PayrollController::class, 'update']);
Route::get('/Payrollsdelete/{id}', [PayrollController::class, 'delete']);

Route::get('/payrolls/salary-slip/{id}', [PayrollController::class, 'generateSalarySlip']);


//____________ Authentication _____________________
#region Auth
Route::get('/register', [AuthenticationController::class,'register']);
Route::post('/registerstore', [AuthenticationController::class,'registerstore']);
Route::get('/login', [AuthenticationController::class,'login']);
Route::post('/loginstore', [AuthenticationController::class,'loginstore']);
Route::get('/logout', [AuthenticationController::class,'logout']);
Route::get('/update', [AuthenticationController::class,'update']);
#endregion