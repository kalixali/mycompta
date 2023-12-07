<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salbrutimp extends Model
{
    use HasFactory;
    protected $table = 'salbrutimp';
    protected $primaryKey = 'id';
    protected $fillable = ['matricule', 'salbase', 'sursal', 'totprimes', 'totavtagenat', 'totmhs', 'totindemnite', 'totindemnitetax', 'totsocemp', 'totficemp', 'salbimp', 'salnet', 'salpaye'];
}
