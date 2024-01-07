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
use App\Http\Controllers\Api\ExtraController;
use App\Http\Controllers\Api\OrderController;

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
Route::apiResource('/extra', ExtraController::class);
Route::post('/salary/{id}', [SalaryController::class, 'paid']);
Route::post('/stock/edit/{id}', [ProductController::class, 'stockUpdate']);
Route::apiResource('/customer', CustomerController::class);
//pos
Route::get('/category/item/{id}', [POSController::class, 'getProduct']);
Route::post('/orderdone', [POSController::class, 'OrderDone']);
//cart
Route::post('/add-cart/{id}', [CartController::class, 'cartInsert']);
Route::get('/all-cart-product', [CartController::class, 'allCartProduce']);
Route::get('/remove/{id}', [CartController::class, 'CartProductRemove']);
Route::get('/increment/{id}', [CartController::class, 'incrementCart']);
Route::get('/decrement/{id}', [CartController::class, 'decrementCart']);
//order
Route::get('/orders', [OrderController::class, 'TodayOeders']);
Route::get('/order/details/{id}', [OrderController::class, 'OrderDetails']);
Route::get('/order/detailsall/{id}', [OrderController::class, 'OrderDetailsAll']);
Route::post('/search/date', [OrderController::class, 'searchOrderDate']);
Route::post('/search/month', [OrderController::class, 'searchOrderMonth']);
//home component
Route::get('/today/sell', [POSController::class, 'todaySell']);
Route::get('/today/income', [POSController::class, 'todayIncome']);
Route::get('/today/due', [POSController::class, 'todayDue']);
Route::get('/today/expanse', [POSController::class, 'todayExpanse']);
Route::get('/stock-out', [POSController::class, 'stockOut']);

