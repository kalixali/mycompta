<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class achats extends Model
{
    use HasFactory;
    protected $table = 'achats';
    protected $primaryKey = 'id';
    protected $fillable = ['prod', 'qtite', 'pu', 'mont', 'tr', 'mtr', 'nccial', 'tesc', 'mtesc', 'nfcier', 'ttva', 'mtva', 'mttc', 'mport', 'mpay'];
}
