<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartitemController;
use App\Http\Controllers\CustomerTransactionController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\SpareController;
use App\Http\Controllers\Supplier_transactionController;
use App\Http\Controllers\SupplierController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login',[AuthController::class,'login']);
Route::post('/elogin',[AuthController::class,'elogin']);
Route::post('/slogin',[AuthController::class,'slogin']);
Route::post('/register',[CustomerController::class,'store']);

Route::group(['middleware'=>['auth:sanctum']],function () {
    Route::post('/logout',[AuthController::class,'logout']);
    Route::post('/elogout',[AuthController::class,'elogout']);
    Route::post('/slogout',[AuthController::class,'slogout']);
    Route::get('/user',[AuthController::class,'user']);
    Route::get('/euser',[AuthController::class,'euser']);
    Route::get('/suser',[AuthController::class,'suser']);
    Route::get('/equipment-search',[EquipmentController::class,'search']);
    Route::get('/spare-search',[SpareController::class,'search']);
    Route::get('/service-search',[ServiceController::class,'search']);
    Route::resource('/customers',CustomerController::class);
    Route::resource('/employees',EmployeeController::class);
    Route::resource('/equipments',EquipmentController::class);
    Route::resource('/spares',SpareController::class);
    Route::resource('/services',ServiceController::class);
    Route::resource('/payments',PaymentController::class);
    Route::get('/payments-total',[PaymentController::class,'total']);
    Route::get('/payments-d-monthly',[PaymentController::class,'monthlyDeductions']);
    Route::get('/payments-i-monthly',[PaymentController::class,'monthlyIncome']);
    Route::get('/payments-approved',[PaymentController::class,'approvedPayments']);
    Route::get('/payments-pending',[PaymentController::class,'pendingPayments']);
    Route::get('/payments-search',[PaymentController::class,'searchWithName']);
    Route::post('/approve-payment',[PaymentController::class,'approvePayment']);
    Route::resource('/inventories',InventoryController::class);
    Route::resource('/suppliers',SupplierController::class);
    Route::resource('/cartitems',CartitemController::class);
    Route::resource('/shippings',ShippingController::class);
    Route::resource('/suptransactions',Supplier_transactionController::class);
    Route::resource('/custransactions',CustomerTransactionController::class);
});