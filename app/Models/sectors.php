<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class sectors extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'zona_id'
    ];

    public function zona()
    {
        return $this->belongsTo(zonas::class);
    }
}
