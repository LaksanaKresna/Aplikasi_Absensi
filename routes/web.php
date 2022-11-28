<?php

use App\Http\Controllers\AttandanceController;
use App\Http\Controllers\AttandanceStatusController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeFaceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobTitleController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MaritalStatusController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Models\Transaction;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class, 'index']);
Route::get('/getFace', [HomeController::class, 'getFace']);
Route::get('/getFaceID', [HomeController::class, 'getFaceID']);
Route::get('/ceklocation', [HomeController::class, 'getCekLocation']);
// Route::get('/generateJsonFace', [HomeController::class, 'generateJsonFace']);

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::middleware('auth')->group(
    function () {  //grouping route hanya boleh diakases ketika login
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::resource('user', UserController::class);
        Route::resource('jobtitle', JobTitleController::class)->except('show');
        Route::resource('maritalstatus', MaritalStatusController::class)->except('show');
        Route::resource('status', StatusController::class)->except('show');
        Route::resource('employee', EmployeeController::class)->except('show');
        Route::resource('employeeface', EmployeeFaceController::class)->except('show', 'edit', 'update');

        Route::resource('attandancestatus', AttandanceStatusController::class)->except('show');
        Route::resource('attandance', AttandanceController::class)->except('show', 'create', 'store');

        Route::resource('category', CategoryController::class);
        Route::resource('product', ProductController::class);
        Route::resource('setting', SettingController::class);
        Route::get('transaction', [TransactionController::class, 'index'])->name('transaction.index');
        Route::get('transaction/create', [TransactionController::class, 'create'])->name('transaction.create');
        Route::get('transaction/{transaction}/edit', [TransactionController::class, 'edit'])->name('transaction.edit');
        Route::get('transaction/{transaction}', [TransactionController::class, 'getTransByQR'])->name('transaction.getTransByQR');
        Route::get('transaction/{transaction}/struk', [TransactionController::class, 'struk'])->name('transaction.struk');
        Route::put('transaction/{transaction}', [TransactionController::class, 'update'])->name('transaction.update');
    }
);
Route::get('attandance/create', [AttandanceController::class, 'create'])->name('attandance.create');
Route::get('attandance/create_admin', [AttandanceController::class, 'createAdmin'])->name('attandance.create.admin');
Route::post('attandance', [AttandanceController::class, 'store'])->name('attandance.store');
Route::post('attandance/create_admin', [AttandanceController::class, 'storeAdmin'])->name('attandance.store.admin');
