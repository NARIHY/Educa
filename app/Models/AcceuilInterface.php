<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcceuilInterface extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'contenu_1',
        'image',
        'liste',
        'contenu_2',
        'status',
        'suprimer'
    ];
}
