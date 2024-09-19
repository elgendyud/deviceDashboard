<?php
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\CreditTransactionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\MaintenceController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\StocksController;
use Illuminate\Support\Facades\Route;


//Users   ******* Login Users ********

Route::get('/',[UserController::class,'showLoginForm'])->name('login');
Route::post('login/user',[UserController::class ,'login'])->name('login.user');
Route::post('/logout', [UserController::class, 'logout'])->name('logout.user');


// Private Pages and Routes ******** User Logged in **********
Route::middleware(['auth'])->group(function () {
Route::get('/dashboard',[DashboardController::class,'home'])->name('dashboard') ;

Route::get('/index',[MaintenceController::class ,'index'])->name('index.maintenance');
// Update Start ******** Active Users

Route::get('/users/toggle-active/{id}', [UserController::class, 'toggleActive'])->name('users.toggleActive');

// Update End 

// to create new User, first, Create The URL of form
Route::get('create/user',[UserController::class, 'create'])->name('create.user'); // to open The URL of Create
// second, the URL of the Storing Action of data into database [ form action='{{route('store.user')}}' ]
Route::post('store/user', [UserController::class,'store'])->name('store.user');
// create a Route to open the URL of index
Route::get('index/user',[UserController::class ,'index'])->name('index.user');
// Create a Route to edit The User Information, and type the edit.name into the 
// <a href='{{ route('edit.user',$user->id )> Update </a> }}' and $user->id to send the id of user
Route::get('edit/user/{id}', [UserController::class, 'edit'])->name('edit.user');
// edit The values when click On update button on the User id page
Route::post('update/user',[UserController::class ,'update'])->name('update.user');
// Change User's Password
Route::get('change/user',[UserController::class,'change'])->name('change.user');
Route::post('changePass/user',[UserController::class , 'changePass'])->name('changePass.user');


// Devices Section Start    ******* Devices ********
// Create a new Device
Route::get('create/device',[DeviceController::class , 'create'])->name('create.device');
Route::post('store/device', [DeviceController::class , 'store'])->name('store.device');
// Show all devices
Route::get('index/device',[DeviceController::class ,'index'])->name('index.device');
// View Specfic Device Details
Route::get('view/device/{id}',[DeviceController::class ,'view'])->name('view.device');
// Delete Device
Route::delete('delete/device/{id}', [DeviceController::class, 'delete'])->name('delete.device');
// Update Device Details . Navigate
Route::get('edit/device/{id}', [DeviceController::class, 'edit'])->name('edit.device');
// Update Values
Route::post('update/device',[DeviceController::class ,'update'])->name('update.device');
// Devices Section End

// Show all Maintences
Route::get('index/maintenance',[MaintenceController::class ,'index'])->name('index.maintenance');
// Create Maintenance
Route::get('create/maintenance',[MaintenceController::class, 'create'])->name('create.maintenance'); // to open The URL of Create
// Store maintenance
Route::post('store/maintenance', [MaintenceController::class,'store'])->name('store.maintenance');
// Delete Maintenance
Route::delete('delete/maintenance/{id}', [MaintenceController::class, 'delete'])->name('delete.maintenance');
// View Specific Maintenance
Route::get('view/maintenance/{id}',[MaintenceController::class ,'view'] )->name('view.maintenance');

// Financel Advanced
// View available credits
Route::get('/credits', [CreditController::class, 'index'])->name('credits.index');
// Add credits form
Route::get('/credits/add', [CreditController::class, 'addCreditForm'])->name('credits.add');
// Process adding credits
Route::post('/credits/add', [CreditController::class, 'addCredit']);




// Show all Purchases
Route::get('index/purchases', [PurchaseController::class, 'index'])->name('purchases.index');
// Purchase form Open the URL
Route::get('create/purchase', [PurchaseController::class, 'create'])->name('purchases.create');
// Process purchase
Route::post('store/purchases', [PurchaseController::class, 'store'])->name('purchases.store');
// View Specific Purchase
Route::get('/purchase/{id}', [PurchaseController::class, 'show'])->name('purchases.show');

// View credit transactions
Route::get('/transactions', [CreditTransactionController::class, 'index'])->name('transactions.index');

// Stock start
Route::get('/stock',[StocksController::class, 'index'])->name('stock.index');

});