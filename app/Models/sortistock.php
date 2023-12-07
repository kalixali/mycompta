<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sortistock extends Model
{
    use HasFactory;
    protected $table = 'sortistock';
    protected $primaryKey = 'id';
    protected $fillable = ['refprod', 'prod', 'qtite', 'pu', 'mont'];
}

