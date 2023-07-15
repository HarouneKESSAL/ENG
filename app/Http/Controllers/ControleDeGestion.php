<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class ControleDeGestion extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all the users
        $users = User::all();
    
        // Get the units for each user
        $units = collect();
        foreach ($users as $user) {
            $units = $units->merge($user->units);
        }
    
        // Return the view
        return view('controle-de-gestion.index', compact('users', 'units'));
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
    public function show(string $id)
    {
        //
    }

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
