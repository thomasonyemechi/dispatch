<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StaffController;
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


Route::group(['middleware' => []], function () {


    Route::get('/admin-login', [AdminController::class, 'loginIndex']);
    Route::post('/staff-login', [AuthController::class, 'staffLogin']);

    Route::group(['prefix' => '/admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
        Route::get('/add-staff', [AdminController::class, 'addStaffIndex']);
        Route::get('/staff-list', [AdminController::class, 'viewAllStaff']);
        Route::get('/staff/{staff_id}', [AdminController::class, 'staffProfileIndex']);
        Route::post('/add-staff', [StaffController::class, 'addStaff']);


        Route::get('/dashboard', [AdminController::class, 'dashboardIndex']);

    });

    Route::get('/login', function () {
        return view('other.login');
    });


    Route::group(['prefix' => '/staff', 'as' => 'staff.', 'middleware' => ['auth']], function () {

        Route::get('/dashboard', function () {
            return view('other.index');
        });

        Route::get('/add-customer', function () {
            return view('other.customers.create_customer');
        });

        Route::controller(CustomerController::class)->group(function () {
            Route::post('add-customer', [CustomerController::class, 'addCustomer']);
            Route::get('customer-list', [CustomerController::class, 'customerList']);
            Route::get('customer/{customer_id}', [CustomerController::class, 'customerProfile']);
        });


        //Order Controller
        Route::controller(OrderController::class)->group(function () {
            Route::get('create-order', 'createOrderIndex')->name('create-order');
            Route::post('create-order', 'createOrder')->name('create-order');
        });


    });


    Route::get('/', function () {
        return view('welcome');
    });
});
