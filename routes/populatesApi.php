<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// employment types
Route::get('employment-types/restore/{id}', [App\Http\Controllers\Api\PopulateController::class, 'restore'])->name('employment-types.restore');
Route::resource('employment-types', App\Http\Controllers\Api\PopulateController::class);
// employment types
Route::get('employee-statuses/restore/{id}', [App\Http\Controllers\Api\PopulateController::class, 'restore'])->name('employee-statuses.restore');
Route::resource('employee-statuses', App\Http\Controllers\Api\PopulateController::class);
// company-types
Route::get('company-types/restore/{id}', [App\Http\Controllers\Api\PopulateController::class, 'restore'])->name('company-types.restore');
Route::resource('company-types', App\Http\Controllers\Api\PopulateController::class);
// departments
Route::get('departments/restore/{id}', [App\Http\Controllers\Api\PopulateController::class, 'restore'])->name('departments.restore');
Route::resource('departments', App\Http\Controllers\Api\PopulateController::class);
// allowance-categories
Route::get('allowance-categories/restore/{id}', [App\Http\Controllers\Api\PopulateController::class, 'restore'])->name('allowance-categories.restore');
Route::resource('allowance-categories', App\Http\Controllers\Api\PopulateController::class);
// contribution-categories
Route::get('contribution-categories/restore/{id}', [App\Http\Controllers\Api\PopulateController::class, 'restore'])->name('contribution-categories.restore');
Route::resource('contribution-categories', App\Http\Controllers\Api\PopulateController::class);
// deduction-categories
Route::get('deduction-categories/restore/{id}', [App\Http\Controllers\Api\PopulateController::class, 'restore'])->name('deduction-categories.restore');
Route::resource('deduction-categories', App\Http\Controllers\Api\PopulateController::class);
// document-categories
Route::get('document-categories/restore/{id}', [App\Http\Controllers\Api\PopulateController::class, 'restore'])->name('document-categories.restore');
Route::resource('document-categories', App\Http\Controllers\Api\PopulateController::class);
// payment-methods
Route::get('payment-methods/restore/{id}', [App\Http\Controllers\Api\PopulateController::class, 'restore'])->name('payment-methods.restore');
Route::resource('payment-methods', App\Http\Controllers\Api\PopulateController::class);
// pay-types
Route::get('pay-types/restore/{id}', [App\Http\Controllers\Api\PopulateController::class, 'restore'])->name('pay-types.restore');
Route::resource('pay-types', App\Http\Controllers\Api\PopulateController::class);
// relationship-type
Route::get('relationship-types/restore/{id}', [App\Http\Controllers\Api\PopulateController::class, 'restore'])->name('relationship-types.restore');
Route::resource('relationship-types', App\Http\Controllers\Api\PopulateController::class);
// info-types
Route::get('info-types/restore/{id}', [App\Http\Controllers\Api\PopulateController::class, 'restore'])->name('info-types.restore');
Route::resource('info-types', App\Http\Controllers\Api\PopulateController::class);
// cities
Route::get('cities/restore/{id}', [App\Http\Controllers\Api\PopulateController::class, 'restore'])->name('cities.restore');
Route::resource('cities', App\Http\Controllers\Api\PopulateController::class);
// states
Route::get('states/restore/{id}', [App\Http\Controllers\Api\PopulateController::class, 'restore'])->name('states.restore');
Route::resource('states', App\Http\Controllers\Api\PopulateController::class);
// roles
Route::get('roles/restore/{id}', [App\Http\Controllers\Api\PopulateController::class, 'restore'])->name('roles.restore');
Route::resource('roles', App\Http\Controllers\Api\PopulateController::class);

