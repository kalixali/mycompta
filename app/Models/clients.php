<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class clients extends Model
{
    use HasFactory;
    protected $table = 'clients';
    protected $primaryKey = 'id';
    protected $fillable = ['sigleclt', 'client', 'cptec', 'contactc1', 'contactc2', 'emailc', 'adressec', 'sitgeoc'];
}
