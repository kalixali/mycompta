<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class achats extends Model
{
    use HasFactory;
    protected $table = 'achats';
    protected $primaryKey = 'id';
    protected $fillable = ['numfact', 'siglefourn', 'refprod', 'prod', 'qtite', 'pu', 'mont', 't_remise', 'remise', 'netccial', 't_escpte', 'escpte', 'netfcier', 'ttva', 'mtva', 'mttc', 'fr_ach', 'netpay', 'cptef', 'cpteach'];
}