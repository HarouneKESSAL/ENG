<?php

use App\Http\Controllers\ActiviteController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\ControleDeGestion;
use App\Http\Controllers\JournalsController;
use App\Http\Controllers\PrevisionsController;
use App\Http\Controllers\ProduitsController;
use App\Http\Controllers\UnitsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\FamilleController;
use App\Http\Controllers\VisiteurController;
use App\Models\Activite;
use App\Models\famille;
use App\Models\Produit;
use App\Models\Unit;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
  return redirect ('login');
});
Auth::routes();

Route::get('/visiteur', function () {
  return "HELLO";
});


################################# units ########################################

Route::resource('/admin/units', UnitsController::class);
Route::get('/admin/units/{unit}/edit', [UnitsController::class, 'edit'])->name('admin.units.edit');
Route::post('/produits', [ProduitsController::class, 'store'])->name('produit.store');
Route::get('/admin/units/create', [UnitsController::class, 'create'])->name('admin.units.create');
Route::post('/admin/units', [UnitsController::class, 'store'])->name('admin.units.store');
Route::get('/admin/units', [UnitsController::class, 'index'])->name('admin.units.index');
Route::get('/units/{id}/edit', [UnitsController::class, 'edit'])->name('admin.units.edit');
Route::put('/units/{id}', [UnitsController::class, 'update'])->name('admin.units.update');
Route::delete('/admin/units/{id}', [UnitsController::class, 'destroy'])->name('admin.units.destroy');
Route::post('/units', [UnitsController::class, 'store'])->name('units.store');

// Route pour créer une unité
Route::get('/units/create', [UnitsController::class, 'create'])->name('units.create');

// Route pour stocker une unité avec ses activités
Route::post('/units/store', [UnitsController::class, 'store'])->name('units.store');

################################# End units ########################################


#######################################################################################


###################################################################################

################## User ############################################################


Route::resource('/admin/users', UsersController::class);
Route::get('/admin/users/{id}/edit', [App\Http\Controllers\UsersController::class, 'edit'])->name('admin.users.edit');
Route::get('/admin/users/create', [UsersController::class, 'create'])->name('admin.users.create');
Route::post('/admin/users', [UsersController::class, 'store'])->name('admin.users.store');


################## END User ############################################################



################################# Produits ########################################

Route::resource('/admin/produits', ProduitsController::class);
Route::get('/admin/produits/create', [ProduitsController::class, 'create'])->name('admin.produits.create');
Route::post('/admin/produits', [ProduitsController::class, 'store'])->name('admin.produits.store');
Route::get('/admin/produits/{id}/edit', [ProduitsController::class, 'edit'])->name('admin.produits.edit');
Route::put('/admin/produits/{id}', [ProduitsController::class, 'update'])->name('admin.produits.update');
Route::delete('/admin/produits/{id}', [ProduitsController::class, 'destroy'])->name('admin.produits.destroy');
Route::get('/admin/produits', [ProduitsController::class, 'index'])->name('admin.produits.index');


################################# End Produits ########################################

################################## activite #################################################

Route::resource('activites', ActiviteController::class);


Route::get('/admin/activites', [ActiviteController::class, 'index'])->name('activites.index');
Route::get('/admin/activites/create', [ActiviteController::class, 'create'])->name('activites.create');
Route::post('/admin/activites', [ActiviteController::class, 'store'])->name('activites.store');
Route::get('/admin/activites/{id}', [ActiviteController::class, 'show'])->name('activites.show');
Route::get('/admin/activites/{id}/edit', [ActiviteController::class, 'edit'])->name('activites.edit');
Route::put('/admin/activites/{id}', [ActiviteController::class, 'update'])->name('activites.update');
Route::delete('/admin/activites/{id}', [ActiviteController::class, 'destroy'])->name('activites.destroy');
Route::put('/activites/{id}', [ActiviteController::class, 'update'])->name('activites.update');



###################################### end activite ###########################################


###################################### famille ###########################################


Route::group(['prefix' => 'admin'], function () {
  Route::resource('familles',FamilleController::class);
});





Route::get('/test-relation', function() {
  $activite = App\Models\Activite::find(1); // Remplacez 1 par l'ID d'une activité existante
  foreach($activite->units as $unit) {
      echo $unit->name . '<br>'; // Affiche le nom de chaque unité associée à l'activité
  }
});





###################################### end famille ###########################################


################################# Role ########################################


Route::middleware(['auth', 'role:admin'])->group(function () {
  Route::resource('admin', AdminsController::class);
  Route::get('/admin', [AdminsController::class, 'index'])->name('admin');
  Route::get('/admin/edit/{journal}', [JournalsController::class, 'edit'])->name('admin.edit');
  Route::put('/admin/edit/{id}', [JournalsController::class, 'update'])->name('admin.update');
 
  
################################# units ########################################

Route::resource('/admin/units', UnitsController::class);
Route::get('/admin/units/{unit}/edit', [UnitsController::class, 'edit'])->name('admin.units.edit');
Route::post('/produits', [ProduitsController::class, 'store'])->name('produit.store');
Route::get('/admin/units/create', [UnitsController::class, 'create'])->name('admin.units.create');
Route::post('/admin/units', [UnitsController::class, 'store'])->name('admin.units.store');
Route::get('/admin/units', [UnitsController::class, 'index'])->name('admin.units.index');
Route::get('/units/{id}/edit', [UnitsController::class, 'edit'])->name('admin.units.edit');
Route::put('/units/{id}', [UnitsController::class, 'update'])->name('admin.units.update');
Route::delete('/admin/units/{id}', [UnitsController::class, 'destroy'])->name('admin.units.destroy');

################################# End units ########################################


#######################################################################################
Route::group(['prefix' => 'admin'], function () {
  Route::resource('familles',FamilleController::class);
});
  
################################## activite #################################################

Route::resource('activites', ActiviteController::class);


Route::get('/admin/activites', [ActiviteController::class, 'index'])->name('activites.index');
Route::get('/admin/activites/create', [ActiviteController::class, 'create'])->name('activites.create');
Route::post('/admin/activites', [ActiviteController::class, 'store'])->name('activites.store');
Route::get('/admin/activites/{id}', [ActiviteController::class, 'show'])->name('activites.show');
Route::get('/admin/activites/{id}/edit', [ActiviteController::class, 'edit'])->name('activites.edit');
Route::put('/admin/activites/{id}', [ActiviteController::class, 'update'])->name('activites.update');
Route::delete('/admin/activites/{id}', [ActiviteController::class, 'destroy'])->name('activites.destroy');
Route::put('/activites/{id}', [ActiviteController::class, 'update'])->name('activites.update');



###################################### end activite ###########################################

###################################################################################

################## User ############################################################


Route::resource('/admin/users', UsersController::class);
Route::get('/admin/users/{id}/edit', [App\Http\Controllers\UsersController::class, 'edit'])->name('admin.users.edit');
Route::get('/admin/users/create', [UsersController::class, 'create'])->name('admin.users.create');
Route::post('/admin/users', [UsersController::class, 'store'])->name('admin.users.store');


################## END User ############################################################



################################# Produits ########################################

Route::resource('/admin/produits', ProduitsController::class);
Route::get('/admin/produits/create', [ProduitsController::class, 'create'])->name('admin.produits.create');
Route::post('/admin/produits', [ProduitsController::class, 'store'])->name('admin.produits.store');
Route::get('/admin/produits/{id}/edit', [ProduitsController::class, 'edit'])->name('admin.produits.edit');
Route::put('/admin/produits/{id}', [ProduitsController::class, 'update'])->name('admin.produits.update');
Route::delete('/admin/produits/{id}', [ProduitsController::class, 'destroy'])->name('admin.produits.destroy');
Route::get('/admin/produits', [ProduitsController::class, 'index'])->name('admin.produits.index');
Route::put('/admin/users/{id}', [UsersController::class, 'update'])->name('admin.users.update');

Route::delete('/admin/users/{id}', [UsersController::class, 'destroy'])->name('admin.users.destroy');
Route::get('/admin/users', [UsersController::class, 'index'])->name('admin.users.index');



################################# End Produits ########################################
});

Route::middleware(['auth', 'role:controle_de_gestion'])->group(function () {
  
  Route::get('controle-de-gestion/create', [JournalsController::class, 'create'])->name('controle-de-gestion.create');
  Route::get('controle-de-gestion/create/{unit}', [JournalsController::class, 'create'])->name('controle-de-gestion.create');
  Route::get('controle-de-gestion/create-previsions', [PrevisionsController::class, 'createPrevisions'])->name('controle-de-gestion.create-previsions');
  Route::post('controle-de-gestion/create-previsions', [PrevisionsController::class, 'storePrevisions'])->name('controle-de-gestion.store-previsions');
  Route::post('controle-de-gestion', [JournalsController::class, 'store'])->name('controle-de-gestion.store');
  Route::get('controle-de-gestion/create/{unit}', [JournalsController::class, 'create'])->name('controle-de-gestion.create');

});

Route::get('/adminedit/{id}', [JournalsController::class, 'edit'])->name('admin.edit');



Route::middleware(['auth', 'role:visiteur'])->group(function () {
  Route::get('/visiteur', [VisiteurController::class, 'index'])->name('visiteur.index');
  Route::get('/visiteur/{id}', [VisiteurController::class, 'show'])->name('visiteur.show');
});


################################# End Role ########################################
################################### Admin ########################################
################################# End Admin ########################################
