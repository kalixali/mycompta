<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stockactu extends Model
{
    use HasFactory;
    protected $table = 'stockactu';
    protected $primaryKey = 'id';
    protected $fillable = ['refprod', 'prod', 'qtite', 'pu', 'mont'];
}
