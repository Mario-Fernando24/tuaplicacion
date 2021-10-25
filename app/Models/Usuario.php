<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AdicionaUsuario;

class Usuario extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'id',
        'name',
        'lastname',
        'telephone',
        'email',
        'address'

    ];

    public function adicion()
    {
        return $this->belongsTo(AdicionaUsuario::class,'id','id_user');
        
    }



}
