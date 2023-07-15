<?php

namespace App\Models;

use App\Models\Journal;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
  use HasFactory;
  public static function rules($id = null)
  {
    return [
      'name' => 'required|unique:units,name,' . $id,
    ];
  }
  public function units()
  {
    return $this->belongsToMany(Unit::class, '_activite__unit');
  }

  public function familles()
  {
    return $this->belongsToMany(Famille::class, '_activite__famille', 'activite_id', 'famille_id')->withPivot('activite_id');
  }

  public function journals()
  {
      return $this->hasMany(Journal::class);
  }
  
}
