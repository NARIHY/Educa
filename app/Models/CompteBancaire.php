<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompteBancaire extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'cin',
        'code_secret',
        'numero_compte',
        'addresse',
        'user_id'
    ];
}
