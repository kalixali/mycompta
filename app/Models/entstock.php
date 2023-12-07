<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class entstock extends Model
{
    use HasFactory;
    protected $table = 'entstock';
    protected $primaryKey = 'id';
    protected $fillable = ['refprod', 'prod', 'qtite', 'pu', 'mont'];
}
