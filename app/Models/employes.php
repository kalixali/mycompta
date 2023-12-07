<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employes extends Model
{
    use HasFactory;
    protected $table = 'employes';
    protected $primaryKey = 'id';
    protected $fillable = ['matricule', 'nom', 'prenoms', 'datenais', 'lieunais', 'nation', 'poste', 'datearriv', 'datemb', 'ancien', 'sitmat', 'nbrenft', 'nbrepart', 'categ', 'txhorair', 'salbase', 'sursal', 'description', 'photo'];
    //protected $fillable = ['matricule', 'nom', 'prenoms', 'datenais', 'lieunais', 'nation', 'datearriv', 'datemb', 'ancien', 'sitmat', 'nbrenft', 'nbrepart', 'categ', 'txhorair', 'salbase', 'sursal', 'avtgnatur', 'prim_diplo', 'prime_rendement', 'prim_risq', 'prime_otr', 'ind_salissure', 'ind_trsport', 'ind_outillage', 'ind_otr', 'description', 'photo'];
}
