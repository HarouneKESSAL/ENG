<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Produit;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitsController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $units = Unit::all();
    return view('admin.units.index', ['units' => $units]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $activites = Activite::all();
    return view('admin.units.create', compact('activites'));
  }
  public function store(Request $request)
  {
    $validatedData = $request->validate(Unit::rules());

    // Vérifier si l'unité avec le même nom existe déjà
    if (Unit::where('name', $validatedData['name'])->exists()) {
      return back()->withInput()->withErrors(['name' => 'Le nom de l\'unité existe déjà.']);
    }

    // Vérifier si l'unité avec le même code existe déjà
    if (Unit::where('code_unit', $validatedData['code_unit'])->exists()) {
      return back()->withInput()->withErrors(['code_unit' => 'Le code de l\'unité existe déjà.']);
    }

    $unit = new Unit();
    $unit->name = $validatedData['name'];
    $unit->code_unit = $validatedData['code_unit'];
    $unit->save();

    if ($request->activites) {
      $activites = Activite::whereIn('id', $request->activites)->get();
      $unit->activites()->attach($activites);
    }

    return redirect()->route('admin.units.index')->with('success', 'Unité créée avec succès.');
  }




  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    $unit = Unit::find($id); // find the unite with the given id or throw a 404 error if it is not found
    return view('admin.units.show', [
      'unit' => $unit,
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit($id)
  {
    $unit = Unit::findOrFail($id);
    $activites = Activite::all();
    return view('admin.units.edit', compact('unit', 'activites'));
  }

  public function update(Request $request, $id)
  {
    $validatedData = $request->validate([
      'name' => 'required|string|max:255',
      'code_unit' => 'required|string|max:255|unique:units,code_unit,' . $id,
      'activites' => 'nullable|array',
      'activites.*' => 'exists:activites,id',
    ]);

    $unit = Unit::findOrFail($id);

    // Vérifier si l'unité avec le même nom existe déjà
    if (Unit::where('name', $validatedData['name'])->where('id', '!=', $unit->id)->exists()) {
      return back()->withInput()->withErrors(['name' => 'Le nom de l\'unité existe déjà.']);
    }
    if (Unit::where('code_unit', $validatedData['code_unit'])->where('id', '!=', $unit->id)->exists()) {
      return back()->withInput()->withErrors(['code_unit' => 'Le code_unit de l\'unité existe déjà.']);
    }
    $unit->name = $validatedData['name'];
    $unit->code_unit = $validatedData['code_unit'];
    $unit->save();

    $unit->activites()->sync($validatedData['activites'] ?? []);

    return redirect()->route('admin.units.index')->with('success', 'Unité modifiée avec succès.');
  }



  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
{
    $unit = Unit::findOrFail($id);
    $unit->Activites()->detach(); // remove all associated products from pivot table
    $unit->delete(); // delete unit
    return redirect()->route('admin.units.index')->with('success', 'Unité supprimée avec succès');
}

}
