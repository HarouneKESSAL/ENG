<?php

namespace App\Http\Controllers;

use Collective\Html\FormFacade as Form;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Unit;
use App\Models\User;
use App\Models\Role;

class UsersController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
      $users = User::with('units')->get();
  
      return view('admin.users.index', compact('users'));
  }
  
  


  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $units = Unit::all(); // assuming you have a Unit model to represent the unit table
    $roles = Role::all();
    return view('admin.users.create', ['units' => $units, 'roles' => $roles]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    // validate the request data
    $validatedData = $request->validate([
      'name' => 'required|unique:users',
      'email' => 'required|email|unique:users',
      'password' => 'required|min:8',
      'unit' => 'required|exists:units,id',
      'role' => 'required|exists:roles,id',
    ]);

    // create the new user
    $user = new User();
    $user->name = $validatedData['name'];
    $user->email = $validatedData['email'];
    $user->password = Hash::make($validatedData['password']);
    $user->save();

    // assign the user role and unit
    $role = Role::find($validatedData['role']);
    $unit = Unit::find($validatedData['unit']);
    $user->roles()->attach($role);
    $user->units()->attach($unit);


    // redirect the user to a success page
    return redirect('/admin/users')->with('success', 'User created successfully.');
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
  public function edit($id)
  {
      $user = User::findOrFail($id);
      $roles = Role::all();
      $units = Unit::all();
  
      return view('admin.users.edit', compact('user', 'roles', 'units'));
  }
  
  public function update(Request $request, $id)
  {
      $user = User::findOrFail($id);
  
      $validatedData = $request->validate([
          'name' => 'required|string|max:255',
          'email' => 'required|email|unique:users,email,' . $user->id,
          'password' => 'nullable|min:6|confirmed',
          'role' => 'required|exists:roles,id',
          'unit' => 'required|exists:units,id'
      ]);
  
      $user->name = $validatedData['name'];
      $user->email = $validatedData['email'];
  
      if ($request->filled('password')) {
          $user->password = Hash::make($validatedData['password']);
      }
  
      $user->roles()->sync($validatedData['role']);
      $user->units()->sync($validatedData['unit']);
  
      $user->save();
  
      return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
  }
  
  

  /**
   * Remove the specified resource from storage.
   */
public function destroy(User $user)
{
    // Delete the user and their roles

    $user->roles()->detach();
    $user->delete();

    // Redirect to the users index page
    return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
}

  
  
}
