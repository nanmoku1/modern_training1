<?php

use App\Http\Controllers\Manage\ProfileController;
use App\Http\Controllers\Manage\ProductsController;
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
Route::get('/test', function () {
    return view('test');
});

Route::get('/manage/dashboard', function () {
    return view('manage.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/manage/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/manage/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/manage/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/manage/products', [ProductsController::class, 'index']);
});

require __DIR__.'/auth.php';
