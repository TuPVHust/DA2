<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\TrucksController;
use App\Http\Controllers\SchedulesController;
use App\Http\Controllers\PartnersController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ScheduleDetailsController;
use App\Http\Controllers\CostDetailsController;
use App\Http\Controllers\CostGroupsController;
use App\Http\Controllers\DriversController;

// use Auth;
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

// Route::get('/boss', function () {
//     return view('boss.dashboard');
// })->middleware(\App\Http\Middleware\Authenticate::class)->middleware(\App\Http\Middleware\BossGuard::class)->name('dashboard');

Route::prefix('boss')->name('boss.')->middleware([CheckAdminLogin::class])->middleware(\App\Http\Middleware\Authenticate::class)->middleware(\App\Http\Middleware\BossGuard::class)->group(function(){
    Route::get('/', function () {
        return view('boss.dashboard');
    })->name('dashboard');
    Route::resources([
        'category' => CategoriesController::class,
        'truck' => TrucksController::class,
        'schedule' => SchedulesController::class,
        'partner' => PartnersController::class,
        'order' => OrdersController::class,
        'schedule_detail' => ScheduleDetailsController::class,
        'cost_detail' => CostDetailsController::class,
        'cost_group' => CostGroupsController::class,
    ]);
    Route::resource('driver', DriversController::class)->only([
        'index', 'show', 'edit' ,'update',
    ]);
});




Route::get('/staff', function () {
    return view('staff.index');
})->middleware(\App\Http\Middleware\Authenticate::class)->middleware(\App\Http\Middleware\StaffGuard::class)->name('index');

Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware(\App\Http\Middleware\AdminGuard::class)->name('home');

Route::get('/', function () {
    if(Auth::user()->role = 2){
        return redirect()->route('home');
    }
    elseif(Auth::user()->role = 1)
    {
        return redirect()->route('boss.dashboard');
    }
    elseif(Auth::user()->role = 0){
        return redirect()->route('index');
    }
    else{
        return redirect()->route('logout');
    }
})->middleware('auth');