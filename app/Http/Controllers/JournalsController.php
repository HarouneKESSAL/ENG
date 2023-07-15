<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Journal;
use App\Models\User;
use App\Models\Activite;
use App\Models\Prevision;
use Illuminate\Support\Facades\Auth;



class JournalsController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $journals = Journal::query();

    // Filter by date
    if ($request->has('date')) {
      $journals->whereDate('date', $request->date);
    }

    // Filter by product ID
    if ($request->has('produit_id')) {
      $journals->where('produit_id', $request->produit_id);
    }

    // Filter by unit ID
    if ($request->has('unit_id')) {
      $journals->where('unit_id', $request->unit_id);
    }

    $journals = $journals->get();
    $products = $journals->groupBy('produit_id');
    $units = $journals->groupBy('unit_id');
    $dates = $journals->groupBy('date');

    $totals = [];
    foreach ($products as $productId => $productJournals) {

      foreach ($dates as $date => $dateJournals) {
        $totals[$productId][$date] = [
          'Realisation_Production' => $productJournals->where('date', $date)->sum('Realisation_Production'),
          'Realisation_Vent' => $productJournals->where('date', $date)->sum('Realisation_Vent'),
          'Realisation_ProductionVendue' => $productJournals->where('date', $date)->sum('Realisation_ProductionVendue'),

          'Previsions_Production' => $productJournals->where('date', $date)->sum('Realisation_Production'),
          'Previsions_Vent' => $productJournals->where('date', $date)->sum('Realisation_Vent'),
          'Previsions_ProductionVendue' => $productJournals->where('date', $date)->sum('Realisation_ProductionVendue'),
        ];
      }
    }

    return view('admin.index', compact('journals', 'totals'));
  }



  /**
   * Show the form for creating a new resource.
   */
  public function create(Request $request)
  {

    $previsions = Prevision::all();
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
    $selectedDate = $request->date; 
    // Passer l'utilisateur connecté, ses unités, les activités, les familles et les produits associés à la vue index
    return view('controle-de-gestion.create', compact('selectedDate','user', 'units', 'activites', 'familles', 'produits'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    


    // validate the form data
    $validatedData = $request->validate([
      'activite_id.*' => 'required|integer',
      'unit_id.*' => 'required|integer',
      'produit_id.*' => 'required|integer',
      'Previsions_Production.*' => 'required|numeric',
      'Previsions_Vent.*' => 'required|numeric',
      'Previsions_ProductionVendue.*' => 'required|numeric',
      'Realisation_Production.*' => 'required|numeric',
      'Realisation_Vent.*' => 'required|numeric',
      'Realisation_ProductionVendue.*' => 'required|numeric',
      'description' => 'required',
      'date' => 'required|date',

    ]);
    // check if a prevision exists in the same month
    
    
 
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

    // $previsions=Prevision::whereYear('date', '=', date('Y', strtotime($validatedData['date'])))
    // ->whereMonth('date', '=', date('m', strtotime($validatedData['date'])))
    // ->get();
    $previsions=Prevision::where('unit_id', $validatedData['unit_id'][0])
        ->whereYear('date', '=', date('Y', strtotime($validatedData['date'])))
        ->whereMonth('date', '=', date('m', strtotime($validatedData['date'])))
        ->get();
    // dd($previsions);

    //     loop through the form data and create Journal models
    foreach($previsions as $i => $prevision) {
      try {
        $journal = new Journal();
       
        $journal->unit_id = $validatedData['unit_id'][0];
        $journal->produit_id = $validatedData['produit_id'][$i];
        
            // Find the matching produit and retrieve its associated famille
        $matchingProduit = $produits->firstWhere('id', $validatedData['produit_id'][$i]);
        if ($matchingProduit) {
            $famille = $matchingProduit->familles->first();
            if ($famille) {
                $activiteId = $famille->activites->first()->id;
                $journal->activite_id = $activiteId;
            } else {
                // Handle the case when no matching famille is found
                throw new \Exception("No matching famille found for produit_id: " . $validatedData['produit_id'][$i]);
            }
        } else {
            // Handle the case when no matching produit is found
            throw new \Exception("No matching produit found for produit_id: " . $validatedData['produit_id'][$i]);
        }
      
      
        $journal->Previsions_Production = ($prevision->Previsions_Production / $prevision->number_of_working_days) ;
        $journal->Previsions_Vent = ($prevision->Previsions_Vent / $prevision->number_of_working_days);
        $journal->Previsions_ProductionVendue = ($prevision->Previsions_ProductionVendue / $prevision->number_of_working_days);
      
               
        $journal->Realisation_Production = $validatedData['Realisation_Production'][$i];
        $journal->Realisation_Vent = $validatedData['Realisation_Vent'][$i];
        $journal->Realisation_ProductionVendue = $validatedData['Realisation_ProductionVendue'][$i];
        $journal->date = $validatedData['date'];
        $journal->description = $validatedData['description'];
        $journal->save();
        $journal->units()->attach($validatedData['unit_id'][0]);
      } catch (\Illuminate\Database\QueryException $ex) {
        $errorCode = $ex->errorInfo[1];
        if ($errorCode == 1062) { // duplicate entry error
          // display custom error message

          return redirect()->back()->with('error','Un journal avec la même unité, la même date et le même produit existe déjà.')->withInput($request->all());
        }
        // rethrow the exception if it's not a duplicate entry error
      }
    }
   
    // Redirect back to the create page
    return redirect()->back()->with('success', 'Le journal a été inséré avec succès!');
  }



  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }


public function edit(string $id)
{

  $journal = Journal::find($id);
  $journal = Journal::find($id);
  if (!$journal) { };
    $user = Auth::user();
    $units = $user->units;
    $activites = collect();
    foreach ($units as $unit) {
        $activites = $activites->merge($unit->activites);
    }
    $familles = collect();
    foreach ($activites as $activite) {
        $familles = $familles->merge($activite->familles);
    }
    $produits = collect();
    foreach ($familles as $famille) {
        $produits = $produits->merge($famille->produits()->with('mesure')->get());
    }
    
    return view('admin.edit', compact('journal', 'user', 'units', 'activites', 'familles', 'produits'));
}

public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        // 'unit_id' => 'required|integer',
        // 'produit_id' => 'required|integer',
        'Previsions_Production' => 'required|numeric',
        'Previsions_Vent' => 'required|numeric',
        'Previsions_ProductionVendue' => 'required|numeric',
        'Realisation_Production' => 'required|numeric',
        'Realisation_Vent' => 'required|numeric',
        'Realisation_ProductionVendue' => 'required|numeric',
        'description' => 'required',
        'date' => 'required|date',
    ]);
    $journal = Journal::find($id);
    if ($journal) {
        // $journal->unit_id = $validatedData['unit_id'];
        // $journal->produit_id = $validatedData['produit_id'];
        $journal->Previsions_Production = $validatedData['Previsions_Production'];
        $journal->Previsions_Vent = $validatedData['Previsions_Vent'];
        $journal->Previsions_ProductionVendue = $validatedData['Previsions_ProductionVendue'];
        $journal->Realisation_Production = $validatedData['Realisation_Production'];
        $journal->Realisation_Vent = $validatedData['Realisation_Vent'];
        $journal->Realisation_ProductionVendue = $validatedData['Realisation_ProductionVendue'];
        $journal->description = $validatedData['description'];
        $journal->date = $validatedData['date'];
    
        $journal->save();
    }
    

    return redirect()->route('admin')->with('success', 'Le journal a été modifié avec succès!');
}
     
 
  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
