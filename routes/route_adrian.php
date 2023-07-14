<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PromovidosController;
use App\Http\Controllers\PromotoresController;
use App\Http\Controllers\CoordinadorDttoController;
use App\Http\Controllers\CoordinadorMpalController;
use App\Http\Controllers\CombosController;


Route::get('/home', [DashboardController::class, 'index'])->name('dashboard.home'); 

Route::get('panel-control/result-index', [DashboardController::class, 'result_data']);
Route::get('panel-control/promovidos/{id_municipio}/municipio', [DashboardController::class, 'promovidos_municipio']);
Route::get('panel-control/promovidos/municipio/results', [DashboardController::class, 'getPromovidosMpio']);

/*Ruta para los coordinadores distritales*/
Route::resource('coordinador-distrital', CoordinadorDttoController::class)->except(['show']);
Route::get('coordinador-distrital/results', [CoordinadorDttoController::class, 'getResult']);
Route::get('coordinador-distrital/get-datos', [CoordinadorDttoController::class, 'getResult']);
Route::post('coordinador-distrital/update', [CoordinadorDttoController::class, 'update']);

/*Ruta para los coordinadores municipales*/
Route::resource('coordinador-municipal', CoordinadorMpalController::class)->except(['show']);
Route::get('coordinador-municipal/results', [CoordinadorMpalController::class, 'getResult']);
Route::get('coordinador-municipal/get-datos', [CoordinadorMpalController::class, 'getResult']);
Route::post('coordinador-municipal/update', [CoordinadorMpalController::class, 'update']);

/*Ruta para los promotores*/
Route::resource('promotores', PromotoresController::class)->except(['index']);
Route::post('promotores/update', [PromotoresController::class, 'update'])->name('promotores.update');
Route::get('promotor/get-datos', [PromotoresController::class, 'getDatos']);


/*Ruta para los promovidos*/
Route::resource('promovidos', PromovidosController::class)->except(['index']);
Route::post('promovidos/update', [PromovidosController::class, 'update'])->name('promovidos.update');


Route::get('promovido/get-datos', [PromovidosController::class, 'getDatos']);

/*Ruta para los selects*/
Route::get('type/school-grade', [CombosController::class, 'school_grade']);
Route::get('type/district', [CombosController::class, 'district']);
Route::get('type/municipality', [CombosController::class, 'municipality']);
Route::get('type/sections', [CombosController::class, 'sections']);
Route::get('type/promoters', [CombosController::class, 'promoters']);
Route::get('type/activities', [CombosController::class, 'activities']);
Route::get('type/municipality-coordinator', [CombosController::class, 'municipality_coordinator']);
Route::get('type/district-coordinator', [CombosController::class, 'district_coordinator']);
Route::get('type/municipality-dtto', [CombosController::class, 'municipality_dtto']);