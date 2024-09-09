<?php

use App\Http\Controllers\SpecialPageController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegistrationController;

Route::get('/', [RegistrationController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/', [RegistrationController::class, 'register'])->name('register');
Route::get('/special-page/imfeelinglucky', [SpecialPageController::class, 'imFeelingLucky'])->name('imfeelinglucky');
Route::get('/special-page/history', [SpecialPageController::class, 'showHistory'])->name('history');
Route::get('/special-page/{link}', [SpecialPageController::class, 'show'])->name('special_page');
Route::get('/special-page/{link}/generate-new', [SpecialPageController::class, 'generateNewLink'])->name('generate_link');
Route::get('/special-page/{link}/deactivate', [SpecialPageController::class, 'deactivateLink'])->name('deactivate_link');
