<?php

namespace App\Models;

use App\Models\Activite;
use App\Models\Journal;
use App\Models\User;
use App\Models\Prevision;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $table = "units";
    protected $fillable = ['name','Position'];
    protected $hidden = ['created_at', 'updated_at', 'pivot'];


    public static function rules($id = null)
    {
        return [
            'name' => 'required|unique:units,name,' . $id,
            'code_unit' => 'required'
        ];
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'unit_user', 'unit_id', 'user_id');
    }
    
    
    public function activites()
    {
        return $this->belongsToMany(Activite::class, '_activite__unit');
    }
    public function journals()
    {
        return $this->belongsToMany(Journal::class, 'journal_unit','unit_id');
    }
    
    public function previsions()
{
    return $this->hasMany(Prevision::class);
}


}

