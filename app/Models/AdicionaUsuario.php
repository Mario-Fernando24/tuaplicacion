<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdicionaUsuario extends Model
{
    protected $table = 'adicionusuario';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'id',
        'id_user',
        'art',
        'cinema',
        'music'
    ];

   
}
