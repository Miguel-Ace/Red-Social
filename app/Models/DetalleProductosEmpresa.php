<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleProductosEmpresa extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'id_empresa',
        'producto_servicio',
        'descripcion',
        'precio',
    ];

    function empresas(){
        return $this->belongsTo(User::class,  'id_empresa');
    }
}
