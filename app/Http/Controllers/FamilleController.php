<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;
use App\Models\Famille;

class FamilleController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $familles = Famille::all();
    return view('admin.familles.index', compact('familles'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
      $produits = Produit::all();
      return view('admin.familles.create', compact('produits'));
  }
  
  public function store(Request $request)
  {
      $request->validate([
          'name' => 'required|unique:familles',
          'produits' => 'required|array|min:1',
          'produits.*.id' => 'required|exists:produits,id',
      ]);
  
      $famille = Famille::create($request->only('name'));
  
      $produits = collect($request->input('produits'))->pluck('id')->toArray();
      $famille->produits()->sync($produits);
  
      return redirect()->route('familles.index')
          ->with('success', 'Famille ajoutée avec succès.');
  }
  
  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    $famille = Famille::findOrFail($id);
    return view('admin.familles.show', compact('famille'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit($id)
{
    $famille = Famille::findOrFail($id);
    $produits = Produit::all();
    return view('admin.familles.edit', compact('famille', 'produits'));
}

/**
 * Update the specified resource in storage.
 */
public function update(Request $request, $id)
{
    $famille = Famille::findOrFail($id);
    $famille->name = $request->input('name');
    $famille->save();

    // Mise à jour des produits associés à la famille
    $produits = $request->input('produits');
    if (!empty($produits)) {
        $produitsIds = [];
        foreach ($produits as $produit) {
            $produitsIds[] = $produit['id'];
        }
        $famille->produits()->sync($produitsIds);
    } else {
        $famille->produits()->detach();
    }

    return redirect()->route('familles.index')->with('success', 'Famille mise à jour avec succès.');
}


  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $famille = Famille::findOrFail($id);
    $famille->produits()->detach(); // Supprimer les relations avec les produits
    $famille->delete(); // Supprimer la famille elle-même
  
    return redirect()->route('familles.index')
      ->with('success', 'Famille supprimée avec succès.');
  }
  
}
