<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salaire extends Model
{
    use HasFactory;
    protected $table = 'salaire';
    protected $primaryKey = 'id';
    protected $fillable = ['matricule', 'nom', 'prenoms', 'poste', 'categ', 'nbrepart', 'salbase', 'sursal', 'nation', 'avg_logement', 'avg_vehicule', 'avg_otr', 'totavtagenat', 'prime_ancien', 'prim_risq', 'prime_otr', 'totprimes', 'txhorair', 'hsup15', 'hsup50', 'hsup75', 'hsup100', 'msup15', 'msup50', 'msup75', 'msup100', 'totmhs','ind_nourriture', 'ind_logement', 'ind_otrtax', 'totindemnitetax', 'salbimp', 'cr', 'imps', 'cn', 'igr', 'totficemp', 'salnet', 'ind_trsport', 'ind_salissure', 'ind_otr', 'totindemnite', 'accompte', 'avance', 'autres', 'totretenues', 'salpaye', 'cptabiliser'];
    
}

