<?php

use App\Http\Livewire\CoordinatorsStructure\CoordinatorForm;
use App\Http\Livewire\CoordinatorsStructure\CoordinatorsStructures;
//use App\Http\Livewire\Dashboard\DashboardHome;

use App\Http\Livewire\Election\Elections;
use App\Http\Livewire\ElectoralStructure\ElectoralSectionsStructures;
use App\Http\Livewire\ElectoralStructure\ElectoralStructures;
use App\Http\Livewire\PromotedsStructure\PromotedsComments;
use App\Http\Livewire\PromotedsStructure\PromotedsStructures;
use App\Http\Livewire\PromotedsStructure\PromotedsSupports;
use App\Http\Livewire\PromotersStructure\PromotersStructures;
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

Auth::routes();



//Route::get('/home', DashboardController::class)->name('dashboard.home');





Route::get('/estructura', ElectoralStructures::class)->name('estructura.index');
Route::get('/estructura/{structureId}/secciones', ElectoralSectionsStructures::class)->name('estructura.secciones');

//Coordinadores
Route::get('/coordinadores', CoordinatorsStructures::class)->name('coordinadores.index');
Route::get('/coordinadores/crear', CoordinatorForm::class)->name('coordinadores.create');
Route::get('/coordinadores/{tree}/editar', CoordinatorForm::class)->name('coordinadores.edit');

//Promovidos
// Route::get('/promovidos', PromotedsStructures::class)->name('promovidos.index');
Route::prefix('promovidos')->group(function () {
    Route::get('/seguimiento/{promoted}', PromotedsComments::class)->name('promovidos.segumiento.index');
    Route::get('/apoyos/{promoted}', PromotedsSupports::class)->name('promovidos.apoyos.index');
});

//Promotores
// Route::get('/promotores', PromotersStructures::class)->name('promotores.index');

Route::get('/elecciones', Elections::class)->name('elecicones.index');

require base_path('routes/route_adrian.php');