<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fournisseurs extends Model
{
    use HasFactory;
    protected $table = 'fournisseurs';
    protected $primaryKey = 'id';
    protected $fillable = ['siglefourn', 'fournisseur', 'cptef', 'contactf1', 'contactf2', 'emailf', 'adressef', 'sitgeof'];
}
