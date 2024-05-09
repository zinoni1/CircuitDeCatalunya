<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class zonas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre'
    ];

    public function sectors()
    {
        return $this->belongsTo(sectors::class, 'sector_id');
    }
}
