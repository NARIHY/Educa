<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageRecu extends Model
{
    use HasFactory;


    protected $fillable = [
        'nom',
        'prenon',
        'email',
        'sujet',
        'introduction',
        'contenu',
        'fin',
        'status',
        'lecteur'
    ];
}
