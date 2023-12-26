<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormBuilderController;
use App\Http\Controllers\ResponseController;
use Illuminate\Support\Facades\Auth;

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
    return view('homepage');
});



Auth::routes();

Route::get('/', [FormBuilderController::class, 'index'])->name('forms.index');
Route::get('/forms/create', [FormBuilderController::class, 'create'])->name('forms.create');
Route::post('/forms', [FormBuilderController::class, 'store'])->name('forms.store');
Route::get('/forms/{form}', [FormBuilderController::class, 'show'])->name('forms.show');

// Route::get('/form-response/{id:id}', [ResponseController::class, 'create'])->name('form_response');
// Route::post('/form-response-store/{id:id}', [ResponseController::class, 'store'])->name('form_response.store');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/form-response/{id:id}', [ResponseController::class, 'create'])->name('form_response');
    Route::post('/form-response-store/{id:id}', [ResponseController::class, 'store'])->name('form_response.store');
    Route::get('/form-response_view/{id:id}', [ResponseController::class, 'show'])->name('form_response_view');
});

