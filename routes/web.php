<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\front\HomeController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\front\DrugController;
use App\Http\Controllers\admin\AdminDrugController;

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
Route::get('/home',[HomeController::class,'index'])->name('home.index');
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('drugs.index');
    } else {
        return redirect()->route('home.index');
    }
});


Route::middleware(['auth', 'verified'])->group(function(){
    Route::resource('/drugs',DrugController::class);
});

Route::prefix('admin')->middleware(['auth', 'verified', 'isAdmin'])->group(function(){
    Route::get('/dashboard', [DashboardController::class,'index'])->name('admin.dashboard');
    Route::get('/drugs', [AdminDrugController::class,'index'])->name('admin.drugs');
    Route::post('/update-approval/{id}',[AdminDrugController::class,'updateApproval'])->name('updateApproval');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
