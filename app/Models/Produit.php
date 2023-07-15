<?php

namespace App\Models;

use App\Models\Journal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Table;


class Produit extends Model
{
    use HasFactory;
    protected $table = "produits";
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at', 'pivot'];

    public function familles()
{
    return $this->belongsToMany(Famille::class, '_famille__produit', 'produit_id', 'famille_id');
}
public function mesure()
{
    return $this->belongsTo(Mesure::class, 'mesure_id');
}


}
