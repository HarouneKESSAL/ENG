<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesure extends Model
{
    use HasFactory;
    protected $table = "mesures";
    protected $fillable = ['name'];
  
    public function produit()
    {
      return $this->hasMany(Produit::class);
    }
}
