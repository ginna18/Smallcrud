<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Planta extends Model{
    use HasFactory,SoftDeletes;


    // campos de la BDD en los que se permite la asignacion masiva
    protected $fillable=['categoria','tipo','nombres',  'nombrec', 'altura','descripcion', 'imagen','user_id','registrada',
    'registro','color',];

    //RETORNA EL USUARIO CREADOR DE LA PLANTA
    public function user(){
        return $this->belongsTo('\App\Models\User');
    }
}
