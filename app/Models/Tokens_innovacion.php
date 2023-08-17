<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tokens_innovacion extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'fecha_hora',
        'id_mi_empresa',
        'id_empresa',
        'cantidad',
        'descripcion',
        'debe',
        'haber',
        'saldo',
    ];

    function miEmpresas(){
        return $this->belongsTo(User::class,  'id_mi_empresa');
    }

    function empresas(){
        return $this->belongsTo(User::class,  'id_empresa');
    }
}
