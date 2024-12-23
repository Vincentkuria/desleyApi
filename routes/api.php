<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartitemController;
use App\Http\Controllers\CustomerTransactionController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceGroupController;
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
    // Route::post('/send-verification-code',[AuthController::class,'sendCode']);
    // Route::post('/verify',[AuthController::class,'verify']);
    // Route::post('/check-verify-status',[AuthController::class,'checkVerifyStatus']);
    Route::get('/user',[AuthController::class,'user']);
    Route::get('/euser',[AuthController::class,'euser']);
    Route::get('/suser',[AuthController::class,'suser']);
    Route::get('/equipment-search',[EquipmentController::class,'search']);
    Route::get('/spare-search',[SpareController::class,'search']);
    Route::get('/service-search',[ServiceController::class,'search']);
    Route::resource('/customers',CustomerController::class);
    Route::get('/customers-search',[CustomerController::class,'searchWithName']);
    Route::post('/update-cus-password',[CustomerController::class,'updateCusPassword']);
    Route::resource('/employees',EmployeeController::class);
    Route::get('/search-employees',[EmployeeController::class,'searchEmployees']);
    Route::get('/search-employees-name',[EmployeeController::class,'searchWithName']);
    Route::post('/update-emp-password',[EmployeeController::class,'updateEmpPassword']);
    Route::post('/approve-employees',[EmployeeController::class,'approveEmployee']);
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
    Route::get('/search-payment-code',[PaymentController::class,'searchWithCode']);
    Route::post('/approve-payment',[PaymentController::class,'approvePayment']);
    Route::resource('/inventories',InventoryController::class);
    Route::get('/inventory-search',[InventoryController::class,'search']);
    Route::post('/status-request-delete',[InventoryController::class,'statusRequestDelete']);
    Route::get('/inventories-approved',[InventoryController::class,'indexApproved']);
    Route::post('/approve-inventories',[InventoryController::class,'approve']);
    Route::post('/cancel-inventories',[InventoryController::class,'cancel']);
    Route::resource('/suppliers',SupplierController::class);
    Route::get('/search-supplier',[SupplierController::class,'searchSupplier']);
    Route::post('/approve-suppliers',[SupplierController::class,'approveSupplier']);
    Route::post('/cancel-suppliers',[SupplierController::class,'cancel']);
    Route::post('/update-sup-password',[SupplierController::class,'updateSupPassword']);
    Route::resource('/cartitems',CartitemController::class);
    Route::resource('/shippings',ShippingController::class);
    Route::get('/shipping-searchwithname',[ShippingController::class,'searchWithName']);
    Route::get('/driver-items',[ShippingController::class,'driverItems']);
    Route::get('/search-shippings',[ShippingController::class,'searchShippings']);
    Route::get('/serviceShipping',[ShippingController::class,'serviceShipping']);
    Route::post('/update-shipping-status',[ShippingController::class,'updateStatus']);
    Route::resource('/suptransactions',Supplier_transactionController::class);
    Route::post('/inventory-delivered',[Supplier_transactionController::class,'inventoryDelivered']);
    Route::get('/suptransactions-approved',[Supplier_transactionController::class,'indexApproved']);
    Route::get('/supplierbillings',[PaymentController::class,'supplierbillings']);
    Route::post('/approve-suptransactions',[Supplier_transactionController::class,'approve']);
    Route::post('/cancel-suptransactions',[Supplier_transactionController::class,'cancel']);
    Route::resource('/custransactions',CustomerTransactionController::class);
    

    Route::get('/idle-service-group',[ServiceGroupController::class,'idleServiceGroups']);
    Route::patch('/assign-jobto-group',[ServiceGroupController::class,'assignJobtoGroup']);
    Route::get('/service-worker-data',[ServiceGroupController::class,'serviceWorkerData']);
    Route::post('/job-done',[ServiceGroupController::class,'jobDone']);

    Route::post('/receive-feedback',[FeedbackController::class,'receiveFeedback']);
    Route::get('/myfeedback',[FeedbackController::class,'myFeedback']);
    Route::get('/myefeedback',[FeedbackController::class,'myeFeedback']);
    Route::post('/replyfeedback',[FeedbackController::class,'replyFeedback']);

    Route::get('/all-order-reports',[CustomerTransactionController::class,'allOrderReports']);
    Route::get('/all-service-reports',[CustomerTransactionController::class,'allServiceReports']);
    Route::get('/all-finance-reports',[PaymentController::class,'allFinanceReports']);
    Route::get('/all-supplier-resource',[Supplier_transactionController::class,'allSupplierResource']);

    Route::get('/ungrouped-service-technicians',[ServiceGroupController::class,'ungroupedServiceTechnicians']);
    Route::post('/assign-group',[ServiceGroupController::class,'assignGroup']);
});