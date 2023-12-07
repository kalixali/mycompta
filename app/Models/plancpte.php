<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class plancpte extends Model
{
    use HasFactory;
    protected $table = 'plancpte';
    protected $primaryKey = 'id';
    protected $fillable = ['compte', 'Libelle'];
}
