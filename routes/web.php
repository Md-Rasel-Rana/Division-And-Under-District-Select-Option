<?php

use App\Http\Controllers\DemoController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/userdashboard', [DemoController::class, 'dashboardpage']);
    Route::get('/District-Create', [DemoController::class, 'DistrictCreate']);
    Route::post('/Create-Division', [DemoController::class, 'CreateDivision']);
    Route::get('/Division-List', [DemoController::class, 'DivisionList']);
    ////  district page----
    Route::get('/District-Page', [DemoController::class, 'Districtpage']);
    Route::post('/District-Save', [DemoController::class, 'DistrictCreatestore']);
    Route::get('/user-info', [DemoController::class, 'userpage']);
    Route::get('/District-List/{divisionId}', [DemoController::class, 'DistrictList']);
    Route::post('/user-store', [DemoController::class, 'userstore']);

});

require __DIR__.'/auth.php';
