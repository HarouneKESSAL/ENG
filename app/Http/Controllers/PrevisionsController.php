<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Prevision;

class PrevisionsController extends Controller
{
    public function createPrevisions()
    {
        // Récupérer l'utilisateur connecté
        $user = Auth::user();
    
        // Récupérer les unités de l'utilisateur connecté
        $units = $user->units;
    
        // Récupérer les activités pour chaque unité de l'utilisateur connecté
        $activites = collect();
        foreach ($units as $unit) {
          $activites = $activites->merge($unit->activites);
        }
    
        // Récupérer les familles pour chaque activité
        $familles = collect();
        foreach ($activites as $activite) {
          $familles = $familles->merge($activite->familles);
        }
    
        // Récupérer les produits pour chaque famille
        $produits = collect();
        foreach ($familles as $famille) {
          $produits = $produits->merge($famille->produits);
        }
       
        return view('controle-de-gestion.create-previsions',  compact('user', 'units', 'activites', 'familles', 'produits')) ;
    }
    public function storePrevisions(Request $request)
  {
    // validate the form data
    $validatedData = $request->validate([
      'unit_id.*' => 'required|integer',
      'produit_id.*' => 'required|integer',
      'Previsions_Production.*' => 'required|numeric',
      'Previsions_Vent.*' => 'required|numeric',
      'Previsions_ProductionVendue.*' => 'required|numeric',
      
      'date' => 'required|date',
      'number_of_working_days'=> 'required|numeric',
    ]);
    // check if a prevision exists in the same month
    // $previsions=Prevision::whereYear('date', '=', date('Y', strtotime($validatedData['date'])))
    // ->whereMonth('date', '=', date('m', strtotime($validatedData['date'])))
    // ->get();
    
    $previsions=Prevision::where('unit_id', $validatedData['unit_id'][0])
        ->whereYear('date', '=', date('Y', strtotime($validatedData['date'])))
        ->whereMonth('date', '=', date('m', strtotime($validatedData['date'])))
        ->get();

    if($previsions->count() > 0) {
      return redirect()->back()->with('error', 'Les prévisions de ce mois-ci sont déjà insérées.');
  }
  
    
    //   Récupérer l'utilisateur connecté
    $user = Auth::user();
    

    // Récupérer les unités de l'utilisateur connecté
    $units = $user->units;

    // Récupérer les activités pour chaque unité de l'utilisateur connecté
    $activites = collect();
    foreach ($units as $unit) {
      $activites = $activites->merge($unit->activites);
    }

    // Récupérer les familles pour chaque activité
    $familles = collect();
    foreach ($activites as $activite) {
      $familles = $familles->merge($activite->familles);
    }

    // Récupérer les produits pour chaque famille
    $produits = collect();
    foreach ($familles as $famille) {
      $produits = $produits->merge($famille->produits);
    }
    $produits = collect();
    foreach ($familles as $famille) {
      $produits = $produits->merge($famille->produits()->with('mesure')->get());
    }
    //     loop through the form data and create Journal models
    for ($i = 0; $i < $produits->count(); $i++) {
     
        $prevision = new Prevision();
 
        $prevision->unit_id = $validatedData['unit_id'][0];
        $prevision->produit_id = $validatedData['produit_id'][$i];
        $prevision->Previsions_Production = $validatedData['Previsions_Production'][$i];
        $prevision->Previsions_Vent = $validatedData['Previsions_Vent'][$i];
        $prevision->Previsions_ProductionVendue = $validatedData['Previsions_ProductionVendue'][$i];
  
        $prevision->date =date('Y-m-d', strtotime($validatedData['date']));
        
        $prevision->number_of_working_days = $validatedData['number_of_working_days'];
        
        $prevision->save();

        $prevision->units()->associate($validatedData['unit_id'][0]);
     $prevision->produits()->associate($validatedData['produit_id'][$i]);
     }

     return redirect()->back()->with('success', 'Les prévisions ont été enregistrées avec succès!');

    }
   
   

    
   
  

  }
