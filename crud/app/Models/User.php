<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
//metodo que recupera todas las plantas relacionadad con el usuario
//como la relacion es 1 a N , usaremos el metodo hasMany()
    public function plantas(){
        return $this->hasMany('\App\Models\Planta');
    }
//recupera los roles de usuarios
    public function roles(){
        return $this->belongsToMany('App\Models\Role');
    }

    //recupera los roles que no tiene el usuario
    public function remainingRoles(){

        $actualRoles=$this->roles; //user roles
        $allRoles= Role::all();    //todos los roles

        //retorna todos los roles menos los que tiene el usuario
        return $allRoles->diff($actualRoles);
    }

    //metodo que indica si un usuario tiene un rol concreto
    //a partie del nombre del rol o array de roles(se aaplica una OR)
    public function hasRole($roleNames):bool{

        //si solamente viene un rol, lo mete en un array
        if (!is_array($roleNames)) 
            $roleNames = [$roleNames];
        

        //recorre la lista de roles buscando...
        foreach ($this->roles as $role) {

            if (in_array($role->role, $roleNames)) 
                return true;//si lo encuentra
        }

        return false; //si no lo encuentra
    }

    public function isOwner(Planta $planta):bool{
        return $this->id==$planta->user_id;
    }
}

