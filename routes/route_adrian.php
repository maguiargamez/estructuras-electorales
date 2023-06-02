<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PromovidosController;
use App\Http\Controllers\CombosController;


Route::get('/home', [DashboardController::class, 'index'])->name('dashboard.home'); 

Route::get('panel-control/result-index', [DashboardController::class, 'result_data']);

/*Ruta para los promovidos*/
Route::resource('promovidos', PromovidosController::class)->except(['index']);



/*Ruta para los selects*/
Route::get('type/school-grade', [CombosController::class, 'school_grade']);
Route::get('type/district', [CombosController::class, 'district']);
Route::get('type/municipality', [CombosController::class, 'municipality']);
Route::get('type/coordinators', [CombosController::class, 'coordinators']);