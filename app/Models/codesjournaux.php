<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class codesjournaux extends Model
{
    use HasFactory;
    protected $table = 'codesjournaux';
    protected $primaryKey = 'id';
    protected $fillable = ['Code', 'Type', 'Designation'];
}
