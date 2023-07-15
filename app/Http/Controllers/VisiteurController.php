<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Journal;
use App\Models\Unit;
use Illuminate\Http\Request;

class VisiteurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       // Get the selected button's from the request
    
    
       $selectedDate = $request->input('selected_date');
       
       $cumule = $request->input('cumule');
       $cumule_jfm = $request->input('cumule_jfm');
    
       if ($request->has('selected_date')) {
        // Filter button was clicked
        
        $selectedDate = $request->input('selected_date');
    
      } else if ($request->has('cumule')) {
        // Cumule button was clicked
       
        $cumule = $request->input('cumule');
      }else if ($request->has('cumule_jfm')) {
        // Cumule JFM button was clicked
       
        $cumule_jfm = $request->input('cumule_jfm');
    }
      
       $today = date('Y-m-d');
    
        // If no date is selected, use today's date
        if (!$selectedDate) {
            $selectedDate = $today;
        }
    
    
        // Récupérer toutes les unités avec leurs activités
        $journalTotals = [];
        $activities = Activite::all();
        $units = Unit::with('activites', 'journals')->get();
    
        // Pour chaque unité, calculer la somme des champs souhaités
        foreach ($units as $unit) {
            if ($unit->journals) {
                 // Filter the journals by date if filter button is clicked
                if ($selectedDate  && !$cumule && !$cumule_jfm) {
                    $journals = $unit->journals->where('date', $selectedDate);
                } 
                else if ($cumule) {
                    // Calculate cumule between first day of the selectedDate's month and the selectedDate
                    $startDate = date('Y-m-01', strtotime($selectedDate));
                    $endDate = $selectedDate;
                    $journals = $unit->journals->whereBetween('date', [$startDate, $endDate])->sortBy('date');
                    
                }
                else if ($cumule_jfm) {
                    // Calculate cumulative of JFM
                    $startDate = date('Y-m-d', strtotime($selectedDate . ' -2 months'));
                    $endDate = date('Y-m-d', strtotime($selectedDate));
                    $journals = $unit->journals->whereBetween('date', [$startDate, $endDate])->sortBy('date');
                }
                $journalTotals[$unit->id] = [
                    'Realisation_Production' => $journals->sum('Realisation_Production'),
                    'Realisation_Vent' => $journals->sum('Realisation_Vent'),
                    'Realisation_ProductionVendue' => $journals->sum('Realisation_ProductionVendue'),
                    'Previsions_Production' => $journals->sum('Previsions_Production'),
                    'Previsions_Vent' => $journals->sum('Previsions_Vent'),
                    'Previsions_ProductionVendue' => $journals->sum('Previsions_ProductionVendue'),
                ];
    
                //create a new array activitesTotals and sum  units that have same activites
                $activitesTotals = [];
                foreach ($unit->activites as $activite) {
                        if ($activite->journals) {
                        // Filter the journals by date if filter button is clicked
                    if ($selectedDate  && !$cumule && !$cumule_jfm) {
                        $journals = $activite->journals->where('date', $selectedDate);
                    } 
                    else if ($cumule) {
                        // Calculate cumule between first day of the selectedDate's month and the selectedDate
                        $startDate = date('Y-m-01', strtotime($selectedDate));
                        $endDate = $selectedDate;
                        $journals = $activite->journals->whereBetween('date', [$startDate, $endDate])->sortBy('date');
                        
                    }
                    else if ($cumule_jfm) {
                        // Calculate cumulative of JFM
                        $startDate = date('Y-m-d', strtotime($selectedDate . ' -2 months'));
                        $endDate = date('Y-m-d', strtotime($selectedDate));
                        $journals = $activite->journals->whereBetween('date', [$startDate, $endDate])->sortBy('date');
                    }
                            $activitesTotals[$activite->id] = [
                                'Realisation_Production' => $journals->sum('Realisation_Production'),
                                'Realisation_Vent' => $journals->sum('Realisation_Vent'),
                                'Realisation_ProductionVendue' => $journals->sum('Realisation_ProductionVendue'),
                                'Previsions_Production' => $journals->sum('Previsions_Production'),
                                'Previsions_Vent' => $journals->sum('Previsions_Vent'),
                                'Previsions_ProductionVendue' => $journals->sum('Previsions_ProductionVendue'),
                            ];
                        }
                    }
    
    
                    
    
    
               
                    $journalTotals[$unit->id]['activitesTotals'] = $activitesTotals;
                  
                $journalTotals[$unit->id]['journals'] = $journals; 
    
            } 
            
        }
        
        return view('visiteur.index', ['journalTotals' => $journalTotals, 'units' => $units, 'activities' => $activities,  'selectedDate'=>$selectedDate,'cumule'=>$cumule,'cumule_jfm'=>$cumule_jfm ]);  
        
    }
       
       
       
    public function show(Request $request)
    {
        $selectedDate = $request->input('selected_date');
        $cumule = $request->input('cumule');
        if ($request->has('cumule')) {
            // Cumule button was clicked
           
            $cumule = $request->input('cumule');
        } else if ($request->has('selected_date')) {
            // Filter button was clicked
            
            $selectedDate = $request->input('selected_date');
        }
        $activities = Activite::all();
        $unit_id = $request->query('unit_id');
        $units = Unit::with('activites', 'journals')->where('id',$unit_id)->get();
    
        $selectedDate = $request->query('selected_date');
        $startDate = date('Y-m-01', strtotime($selectedDate));
        $endDate = $selectedDate;
        
        
       $journalTotals = [];
    
    if ($cumule) {
        $journalsCumule = Journal::whereBetween('date', [$startDate, $endDate])->where('unit_id', $unit_id)->get()->groupBy('date');
    
        foreach ($journalsCumule as $date => $journals) {
            $journalTotals[$date] = [
                'Realisation_Production' => $journals->sum('Realisation_Production'),
                'Realisation_Vent' => $journals->sum('Realisation_Vent'),
                'Realisation_ProductionVendue' => $journals->sum('Realisation_ProductionVendue'),
                'Previsions_Production' => $journals->sum('Previsions_Production'),
                'Previsions_Vent' => $journals->sum('Previsions_Vent'),
                'Previsions_ProductionVendue' => $journals->sum('Previsions_ProductionVendue'),
            ];
        }
    
       
        // Create a new collection that contains all journal entries for the date range
        $journalsAll = collect();
        foreach ($journalsCumule as $date => $journals) {
            $journalsAll = $journalsAll->merge($journals);
        }
    
        // Calculate total values for each column using the new collection
        $totalRealisationProduction = $journalsAll->sum('Realisation_Production');
        $totalRealisationVent = $journalsAll->sum('Realisation_Vent');
        $totalRealisationProductionVendue = $journalsAll->sum('Realisation_ProductionVendue');
        $totalPrevisionsProduction = $journalsAll->sum('Previsions_Production');
        $totalPrevisionsVent = $journalsAll->sum('Previsions_Vent');
        $totalPrevisionsProductionVendue = $journalsAll->sum('Previsions_ProductionVendue');
    
        // Add total values to the $journalTotals array
        $journalTotals['Total'] = [
            'Realisation_Production' => $totalRealisationProduction,
            'Realisation_Vent' => $totalRealisationVent,
            'Realisation_ProductionVendue' => $totalRealisationProductionVendue,
            'Previsions_Production' => $totalPrevisionsProduction,
            'Previsions_Vent' => $totalPrevisionsVent,
            'Previsions_ProductionVendue' => $totalPrevisionsProductionVendue,
        ];
    }else if ($selectedDate) {
        $journals = Journal::where('date', $selectedDate)->get()->sortBy('date');
    }
      
        return view('visiteur.show', [ 'journalTotals' => $journalTotals,'journals' => $journals, 'units' => $units, 'activities' => $activities,'selectedDate' => $selectedDate,'unit_id'=>$unit_id]);
    }
       

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
