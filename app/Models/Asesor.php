<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asesor extends Model
{
    use HasFactory;
    protected $table='asesors';
    // protected $guarded =[];
    protected $fillable = ['nik', 'nama', 'alamat', 'sex', 'email', 'no_hp', 'status', 'skema'];

}
