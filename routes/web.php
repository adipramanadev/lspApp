<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsesorController;
use App\Http\Controllers\SchemaController;

Route::redirect('/', '/dashboard-general-dashboard');

Route::prefix('admin')->group(function(){
    Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');

    //data asesor 
    Route::get('asesor/data', [AsesorController::class, 'getAsesorData'])->name('asesor.data');
    Route::get('asesor/edit/{id}', [AsesorController::class,'edit'])->name('asesor.edit');
    Route::get('asesor', [App\Http\Controllers\AsesorController::class,'index'])->name('asesor.index');
    Route::get('asesor/create', [App\Http\Controllers\AsesorController::class,'create'])->name('asesor.create');
    Route::post('asesor/post',[App\Http\Controllers\AsesorController::class,'store'])->name('asesor.store');
    Route::delete('asesor/delete/{id}', [App\Http\Controllers\AsesorController::class,'destroy'])->name('asesor.destroy');
    Route::put('asesor/update/{id}',[App\Http\Controllers\AsesorController::class,'update'])->name('asesor.update');

    //data Skema
    Route::get('skema', [SchemaController::class,'index'])->name('skema.index');
});