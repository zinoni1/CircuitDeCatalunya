<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class averias extends Model
{
    use HasFactory;
    protected $fillable = ['Incidencia',
    'descripcion', 
    'data_inicio', 
    'data_fin', 
    'prioridad', 
    'imagen', 
    'creator_id', 
    'tecnico_asignado_id', 
    'asignador', 
    'zona_id', 
    'tipo_averias_id'];
}
