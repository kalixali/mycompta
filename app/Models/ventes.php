<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ventes extends Model
{
    use HasFactory;
    protected $table = 'ventes';
    protected $primaryKey = 'id';
    protected $fillable = ['numfact', 'sigleclt', 'refprod', 'prod', 'qtite', 'pu', 'mont', 't_remise', 'remise', 'netccial', 't_escpte', 'escpte', 'netfcier', 'ttva', 'mtva', 'mttc', 'fr_vte', 'netpay', 'cptevte', 'cptec'];
}
