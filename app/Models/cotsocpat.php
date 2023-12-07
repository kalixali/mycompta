<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cotsocpat extends Model
{
    use HasFactory;
    protected $table = 'cotsocpat';
    protected $primaryKey = 'id';
    protected $fillable = ['matricule', 'nom', 'prenoms', 'salbimp', 't_prest_fam', 'prest_fam', 't_acc_trv', 'acc_trv', 't_cr_p', 'cr_p', 'cptabiliser_soc'];
}
