<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class averias_anonimas extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'descripcion',
        'imagen',
    ];
}
