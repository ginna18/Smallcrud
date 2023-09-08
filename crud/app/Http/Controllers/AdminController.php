<?php

namespace App\Http\Controllers;

use App\Models\planta;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class AdminController extends Controller{
    
    public function deletedPlantas(){

        //TODO: recupera las plantas
        $plantas = planta::onlyTrashed()
                ->paginate(config('pagination.plantas',10));

        //carga la vista
        return view('plantas.deleted', ['plantas' => $plantas]);
        // dd('felicidades, has superado el middleware is_admin :D');
    }
    //
        //muestara la lista de usuarios
    public function userList(){
        $users = User::orderBy('name', 'ASC')
            ->paginate(config('pagination.users',10));

            return view('admin.users.list', ['users'=> $users]);
    }


    //muestra un usuario
    public function userShow(User $user){

        //carga la vista de detalles y le pasa el usuario recuperado
        return view('admin.users.show',['user'=>$user]);
        
    }

    //metodo que busca usuarios
    public function userSearch(Request $request){
        $request->validate(['name'=>'max:32','email'=>'max:32']);

        //toma los valoren que llegan paraa nombre y email
        $name=$request->input('name','');
        $email=$request->input('email','');

        //recupera los resultados , añadimos categoria y tipo al paginator
        //para que haga bien los enlaces y se mantenga el filtro al pasasr de pagina

        $users= User::orderBy('name','ASC')
                ->where('name','like',"%name%")
                ->where('email','like',"%email%")
                ->paginate(config('pagination.users'))
                ->appends(['name'=>$name, 'email'=>$email]);

        //retorna la vista de lista con el filtro aplicado
        return view('admin.users.list',['users'=>$users, 'name'=>$email,]);
    }


    //añade un rol a un usuario
    public function setRole(Request $request){
        $role = Role::find($request->input('role_id'));
        $user = User::find($request->input('user_id'));

        //intenta añadir el rol
        try {
            $user->roles()->attach($role->id, [
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return back()
            ->with('success',"Rol $role->role añadido a $user->name correctamente.");

            //si no lo consigue... (use illuminate\Database\queryException)
        } catch (QueryException $e) {
            return back()
                ->withErrors("No se pudo añadir el rol $role->role a $user->name. 
                                Es posible que ya lo tenga.");
        }
    }

     //quita el rol a un usuario
     public function removeRole(Request $request){
        $role = Role::find($request->input('role_id'));
        $user = User::find($request->input('user_id'));
       
        //intenta quitar el rol
         try {
            $user->roles()->detach($role->id);
                return back()
                ->with('success',"Rol $role->role quitado a $user->name correctamente.");

                //SI NO LO CONSIGUE..
         }catch(QueryException $e){
                return back()
                        ->withErrors("No se pudo quitar el rol $role->role a $user->name.");
         }
    }


}
