<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Unit;
use App\Models\Mesure;
use Illuminate\Http\Request;

class ProduitsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $produits = Produit::with('mesure')->get();
        
      return view('admin.produits.index', compact('produits'));
      
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Produit = Produit::all();
        $mesures = Mesure::all();
        return view('admin.produits.create', [
            'Produit' => $Produit,
            'mesures' => $mesures
        ]);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'nameproduit' => 'required|string|max:255',
            'mesure_id' => 'required|integer|exists:mesures,id'
        ], [
            'nameproduit.required' => 'Le champ nom de produit est obligatoire.',
            'mesure_id.required' => 'Le champ mesure est obligatoire.',
            'mesure_id.exists' => 'La mesure sélectionnée est invalide.'
        ]);
    
        // Extract the validated data
        $name = $validatedData['nameproduit'];
        $mesureId = $validatedData['mesure_id'];
    
        // Check if a product with the same name already exists
        $produitExists = Produit::where('name', $name)->exists();
        if ($produitExists) {
            // If the product exists, return to the previous page with an error message
            return back()->withErrors(['nameproduit' => 'Le nom du produit existe déjà']);
        }
    
        // Create a new product with the provided name and mesure_id
        $produit = new Produit();
        $produit->name = $name;
        $produit->mesure_id = $mesureId;
        $produit->save();
    
        // Redirect to the index page for the products
        return redirect()->route('admin.produits.index');
    }
    
    

    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      $produit = Produit::findOrFail($id);

      // Retourner la vue de détails du produit avec les données récupérées
      return view('produit.show', compact('produit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $produit = Produit::findOrFail($id);
        $mesures = Mesure::all();
    
        return view('admin.produits.edit', compact('produit', 'mesures'));
    }
    
    public function update(Request $request, $id)
    {
        $produit = Produit::findOrFail($id);
        $produit->name = $request->nameproduit;
        $produit->mesure_id = $request->mesure_id;
        $produit->save();
    
        return redirect()->route('admin.produits.index')->with('success', 'Produit mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Trouver le produit à supprimer
        $produit = Produit::findOrFail($id);
        
        // Supprimer le produit
        $produit->delete();
    
        // Rediriger vers la page d'index avec un message de confirmation
        return redirect()->route('admin.produits.index')->with('success', 'Le produit a été supprimé avec succès.');
    }

}
