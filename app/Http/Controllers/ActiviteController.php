<?php

namespace App\Http\Controllers;

use App\Models\famille;
use Illuminate\Http\Request;
use App\Models\Activite;

class ActiviteController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $familles = Famille::all();

    $activites = Activite::all();
    return view('admin.activites.index', compact('activites', 'familles'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $familles = Famille::all();
    return view('admin.activites.create', compact('familles'));
  }

  /**
   * Store a newly created resource in storage.
   */

  public function store(Request $request)
  {
    // Validate form data
    $validatedData = $request->validate([
      'name' => 'required|unique:activites',  
      'familles' => 'required|array|min:1',
      'familles.*' => 'integer|exists:familles,id',
    ]);

    // Create new activity
    $activity = new Activite;
    $activity->name = $validatedData['name'];
    $activity->save();

    // Attach families to the activity
    $activity->familles()->attach($validatedData['familles']);

    // Redirect to index page with success message
    return redirect()->route('activites.index')
      ->with('success', 'Activité créée avec succès.');
  }
  /**
   * Display the specified resource.
   */
  public function show(Activite $activite)
  {
    $units = $activite->units;
    return view('admin.activites.show', compact('activite', 'units'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit($id)
{
    // Récupérer l'activité à modifier
    $activite = Activite::findOrFail($id);

    // Récupérer toutes les familles associées à cette activité
    $familles = Famille::all();

    // Renvoyer la vue d'édition avec les données récupérées
    return view('admin.activites.edit', compact('activite', 'familles'));
}


  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Activite $activite)
  {
      $request->validate([
          'name' => 'required|max:255|unique:activites,name,'.$activite->id,
          'familles' => 'array',
      ]);
  
      // Update the name of the activity
      $activite->name = $request->name;
  
      // Update the associated families
      $activite->familles()->sync($request->familles);
  
      $activite->save();
  
      return redirect()->route('activites.index')->with('success', 'L\'activité a été modifiée avec succès.');
  }
  

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
      $activite = Activite::findOrFail($id);
      $activite->familles()->detach(); // Supprimer les relations avec les familles
      $activite->delete(); // Supprimer l'activité elle-même
  
      return redirect()->route('activites.index')
          ->with('success', 'Activité supprimée avec succès.');
  }

  }
