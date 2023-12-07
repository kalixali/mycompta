<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use HasFactory;
    protected $table = 'entreprise';
    protected $primaryKey = 'id';
    protected $fillable = ['sigle', 'nom_complet', 'numCC', 'numRC', 'adresse', 'contact1', 'contact2', 'email', 'sitgeo', 'logo'];
}
