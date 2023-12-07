<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cotficpat extends Model
{
    use HasFactory;
    protected $table = 'cotficpat';
    protected $primaryKey = 'id';
    protected $fillable = ['matricule', 'nom', 'prenoms', 'nation', 'salbimp', 't_is_p', 'is_p', 't_ta_fdfp', 'ta_fdfp', 't_fpc_fdfp', 'fpc_fdfp', 'cptabiliser_fisc'];
}
