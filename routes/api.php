<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\CategorieController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\SalaryController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\POSController;
use App\Http\Controllers\Api\CartController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([
    'middleware' => 'api',
	'prefix' => 'auth'
	
], function () {

	Route::post('login', [AuthController::class, 'login']);
	Route::post('logout', [AuthController::class, 'logout']);
	Route::post('refresh', [AuthController::class, 'refresh']);
	Route::post('me', [AuthController::class, 'me']);
	Route::post('payload', [AuthController::class, 'payload']);
	Route::post('register', [AuthController::class, 'register']);
});
Route::apiResource('/employee', EmployeeController::class);
Route::apiResource('/supplier', SupplierController::class);
Route::apiResource('/category', CategorieController::class);
Route::apiResource('/product', ProductController::class);
Route::apiResource('/expense', ExpenseController::class);
Route::apiResource('/salary', SalaryController::class);
Route::post('/salary/{id}', [SalaryController::class, 'paid']);
Route::post('/stock/edit/{id}', [ProductController::class, 'stockUpdate']);
Route::apiResource('/customer', CustomerController::class);
//pos
Route::get('/category/item/{id}', [POSController::class, 'getProduct']);
//cart
Route::post('/add-cart/{id}', [CartController::class, 'cartInsert']);
Route::get('/all-cart-product', [CartController::class, 'allCartProduce']);

