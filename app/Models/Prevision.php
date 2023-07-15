<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Unit;
use App\Models\Produit;
class Prevision extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "previsions";
    protected $fillable = [
        'unit_id',
        'produit_id',
        'Previsions_Production',
        'Previsions_Vent',
        'Previsions_ProductionVendue',
        'date',
        'number_of_working_days',
    ];

    public function units()
{
    return $this->belongsTo(Unit::class, 'unit_id');
}
public function journal()
{
    return $this->belongsTo(Journal::class);
}


    public function produits()
    {
        return $this->belongsTo(Produit::class);
    }
}
