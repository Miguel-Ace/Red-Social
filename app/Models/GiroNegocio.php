<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiroNegocio extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'giro_negocio',
        'id_categoria_giro',
    ];

    function categoriaGiros(){
        return $this->belongsTo(CategoriaGiro::class,  'id_categoria_giro');
    }
}
