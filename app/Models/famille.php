<?php

namespace App\Models;

use App\Models\Activite;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class famille extends Model
{
    use HasFactory;
    protected $fillable = [
      'name'
  ];




  public function produits()
  {
      return $this->belongsToMany(Produit::class, '_famille__produit', 'famille_id', 'produit_id');
  }


  public function activites()
  {
      return $this->belongsToMany(Activite::class, '_activite__famille', 'famille_id', 'activite_id')->withPivot('activite_id');
  }
  
}
