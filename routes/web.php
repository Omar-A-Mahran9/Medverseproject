<?php

 use App\Http\Controllers\Admin\Usercontroller;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Admin\CustomerserviceController;
use App\Http\Controllers\AppointmenController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\GroupproductController;
use App\Http\Controllers\Main\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PackagesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QutationController;
use App\Http\Controllers\RequestsController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserInventoryController;
use App\Models\ClinicInventory;
use App\Models\Order;
use App\Models\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;

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

// all routes for admin only
Route::group(['middleware'=>['is_admin']], function () {
    Route::post('/api/users',[Usercontroller::class,'store']);
    Route::get('/api/users/search',[Usercontroller::class,'search']);
    Route::patch('/api/users/{user}/change-role',[Usercontroller::class,'changeRole']);
    Route::get('/comments',[CustomerserviceController::class,'index'])->name('comments');
    Route::delete('/comments/delete/{id}',[CustomerserviceController::class,'destroy']);
    Route::post('/api/settings',[SettingController::class,'update']);
    Route::get('/api/order',[OrderController::class,'index']);
    Route::delete('/api/order/delete/{id}',[OrderController::class,'destroy']);
    Route::put('/api/users/update/{user}',[Usercontroller::class,'update']);
    Route::delete('/api/users/delete/{user}',[Usercontroller::class,'destroy']);
    Route::post('/product',[ProductController::class,'store']);
    Route::get('/product',[ProductController::class,'index']);
    Route::post('/quotation',[QutationController::class,'store']);
    Route::put('/product/update/{product}',[ProductController::class,'update']);
     Route::delete('/requests/delete/{id}',[RequestsController::class,'destroy']);
    Route::post('/api/event/edit/{id}',[EventsController::class,'update']);
    Route::delete('/api/event/delete/{id}',[EventsController::class,'destroy']);
    Route::post('/addevent',[EventsController::class,'store']);
    Route::post('/addsession',[SessionController::class,'store']);
    Route::delete('/api/session/delete/{id}',[SessionController::class,'destroy']);
    Route::delete('/api/deleteappointment/{id}',[AppointmenController::class,'destroy']);
});
 
 
// all routes for supplier only
Route::group(['middleware'=>['is_supplier']], function () {

});
// all routes for user only
Route::group(['middleware'=>['is_user']], function () {
    Route::get('/admin/dashboard',[ApplicationController::class,'index']);
    Route::put('/inventoryuser/update/{product}',[UserInventoryController::class,'update']);
    Route::post('/api/clinics',[ClinicController::class,'store']);
    Route::post('/api/order',[OrderController::class,'store']);
    Route::post('/api/customerservice',[CustomerserviceController::class,'store']);

});
// all routes for client only
Route::group(['middleware'=>['is_client']], function () {

});

// all routes including
 

Route::group(['middleware'=>['auth']], function () {
    Route::post('/addsession',[SessionController::class,'store']);
    Route::post('/updatesession',[SessionController::class,'update']);
    Route::post("/api/paypackage",[PackagesController::class,'store']);
    Route::delete('/product/delete/{id}',[ProductController::class,'destroy']);
    Route::patch('/product/addquantity',[ProductController::class,'addquantity']);
    Route::get('/getqutation/{request}',[QutationController::class,'show']);
    Route::put('/quotation/{statue}',[QutationController::class,'changestatue']);
    Route::get('/api/time/{calenderid}',[SessionController::class,'gettime']);
    Route::get('/api/calendar/{id}',[SessionController::class,'calendar']);
    
    Route::get('/api/users',[Usercontroller::class,'index']);

    Route::get('/profile',[ProfileController::class,'profile'])->name('profile');
    Route::post('/api/profile',[ProfileController::class,'store']);
    Route::get('/api/profile',[ProfileController::class,'index']);

    Route::post('/api/uploadimage',[ProfileController::class,'uploadimage']);
    Route::post('/api/updatepass',[ProfileController::class,'updatepass']);
    Route::get('/api/settings',[SettingController::class,'index']);
    Route::get('/api/currentuser',[Usercontroller::class,'currentuser']);
    Route::get('/api/clinics/{id}',[ClinicController::class,'index']);
    Route::patch('/api/request/{request}/change-statue',[RequestsController::class,'changeRole']);
    Route::post('/newrequestcreate',[RequestsController::class,'store']);
    Route::put('/request/{id}',[RequestsController::class,'update']);
    Route::get('/requests/{id}',[RequestsController::class,'index']);
    Route::get('/api/usersobject',[Usercontroller::class,'users']);
    Route::get('/productperuser/{id}',[ProductController::class,'indexproduct']);
    Route::get('/api/events',[EventsController::class,'index']);
    Route::get('/group',[GroupproductController::class,'index']);
    Route::get('/group/{id}',[GroupproductController::class,'show']);

    Route::get('/admin/{view}',ApplicationController::class)->where('view','(.*)');
    // Route::get('/home',[ApplicationController::class,'index']);
    Route::get('/admin',[ApplicationController::class,'index']);
    Route::get('/api/session',[SessionController::class,'index']);
    Route::get('/api/session/{id}',[SessionController::class,'sessionitemforbooking']);
    Route::get('/api/gettime/{id}',[SessionController::class,'gettime']);
    Route::post('/api/appointment',[AppointmenController::class,'store']);
    Route::get('/api/appointment',[AppointmenController::class,'index']);
    Route::get('/api/clinicinventory/{id}',[UserInventoryController::class,'indexproduct']);
    Route::get('/clinicproduct/{id}',[UserInventoryController::class,'clinicproduct']);
    Route::patch('/api/clinicproduct/{id}/change-quantity',[UserInventoryController::class,'changequantity']);

    Route::delete('/api/clinicproduct/delete/{id}',[UserInventoryController::class,'deleitem']);
    Route::post('/api/filter/{id}',[RequestsController::class,'filter']);
    Route::post('/api/analysis/{id}',[RequestsController::class,'analysis']);

});






//front Routing
Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/inventory',[HomeController::class,'service'])->name('service');
Route::get('/consultant',[HomeController::class,'service'])->name('service');
Route::get('/academic',[HomeController::class,'service'])->name('service');
Route::post('/register',[Usercontroller::class,'Register']);
Route::get('/register',[Usercontroller::class,'Registerr'])->name('register');
Route::get('/packages/{type}',[PackagesController::class,'index'])->name('packages');

Route::get('/product',[ProductController::class,'index']);

// Route::get('/', function () {
//     return view('acadimec/acadimec');
// });


// Route::get('/academic',[HomeController::class,'service'])->name('service');

