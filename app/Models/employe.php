<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employe extends Model
{
    use HasFactory;
    protected $table = 'employe';
    protected $primaryKey = 'id';
    protected $fillable = ['matricule', 'nom', 'prenoms', 'datenais', 'lieunais', 'nation', 'poste', 'datearriv', 'datemb', 'ancien', 'sitmat', 'nbrenft', 'nbrepart', 'categ', 'txhorair', 'salbase', 'sursal', 'photo', 'description', 'avg_logement', 'avg_vehicule', 'avg_otr', 'prime_ancien', 'prime_diplo', 'prime_rendement', 'prim_risq', 'prime_otr', 'ind_salissure', 'ind_trsport', 'ind_outillage', 'ind_tournee', 'ind_otr', 'ind_logement', 'ind_nourriture', 'ind_otrtax'];
}
