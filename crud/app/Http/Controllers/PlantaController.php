<?php

namespace App\Http\Controllers;

use App\Events\FirstPlantaCreated;
use App\Http\Requests\PlantaDeleteRequest;
use App\Http\Requests\PlantaUpdateRequest;
use Illuminate\Http\Request;
use App\Models\planta;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PlantaController extends Controller{
    //constructor
    public function __construct()
    {
        //ponemos el middleware auth a todos los metodos excepto:
        //lista de motos
        //detalles de moto
        //busqueda de motos
        $this->middleware('auth')->except('index','show','search');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //recupera las plantas de la BDD usando el modelo
        //ordenado por id descendiente y paginacion de 10 res de la pag
        $plantas = Planta::orderBy('id', 'DESC')->paginate(10);
        // total de plantas en la BDD (para mostar)
        $total = Planta::count();
        return view('plantas.list', ['plantas' => $plantas, 'total' => $total]);
    }
    //
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //mostrar formulario
        return view('plantas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Planta $planta){
        $request->validate([
            'categoria' => 'required|max:255',
            'tipo' => 'required|max:255',
            'nombres' => 'required|max:255',
            'nombrec' => 'required|max:255',
            'descripcion' => 'required|max:255',
            'altura' => 'required|integer|min:0',
            'registrada' => 'required_with:registro',
            'registro' => "required_if:registrada,1|
                            nullable|
                            regex:/^\d{4}[B-Z]{3}$/i|
                            unique:plantas,registro,$planta->id",
            'color' => 'nullable|regex:/^#[\dA-F]{6}$/i',
            'imagen' => 'sometimes|file|image|mimes:jpg,png,gif,webp|max:2048',
        ]);
        //recuperar datos del formulario ecepto la imagen
        $datos = $request->only([
            'categoria',
            'tipo',
            'nombres',
            'nombrec',
            'descripcion',
            'altura',
            'registrada',
            'registro',
            'color'
        ]);

        //el valor para la imagen por defecto sera null
        $datos += ['imagen' => null];

        //RECUPERACION DE LA IMAGEN
        if ($request->hasFile('imagen')) {
            //sube la imagen al directorio indicado en el fichero de config
            $ruta = $request
                ->file('imagen')
                ->store(config('filesystems.plantasImageDir'));

            // nos quedadmos solo con el nombre del fichero solo pqra agregarlo a la DB
            $datos['imagen'] = pathinfo($ruta, PATHINFO_BASENAME);
        }
        //recupera el id del usuario identificado y lo guarda en user_id de la moto
            $datos['user_id'] = $request->user()->id;

        //creacion y guardado de la nueva planta con post
        $planta = Planta::create($datos);


        if($request->user()->plantas->count()==1)
            FirstPlantaCreated::dispatch($planta, $request->user());

        //redireccion de los detalles de la planta
        return redirect()
            ->route('plantas.show', $planta->id)
            ->with('success',"Planta $planta->categoria $planta->tipo añadida satisfactoriamente")
            ->cookie('lastInsertID', $planta->id, 0);// adjun una cookie
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Planta $planta)
    {
        return view('plantas.show', ['planta' => $planta]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Planta $planta)
    {
        // $planta=Planta::findOrFail($id);
        //
        return view('plantas.update', ['planta' => $planta]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlantaUpdateRequest $request, Planta $planta)
    {
        // toma los datos del formulario
        $datos = $request->only(
            'categoria',
            'tipo',
            'nombres',
            'nombrec',
            'descripcion',
            'altura',
            'registro',
            'color'
        );

        //estos datos no se pueden tomar directamente
        $datos['registrada']=$request->has('registrada')? 1 : 0;
        $datos['registro']=$request->has('registrada')? $request->input('registro') : NULL;
        $datos['color']=$request->input('color') ?? NULL;
        if ($request->hasFile('imagen')) {
            //marcamos la imagen antigua para ser borrada si el update va bien
            if ($planta->imagen) {
                $aBorrar =
                    config('filesystems.plantasImageDir') .
                    '/' .
                    $planta->imagen;
            }

            //sube la imagen al directorioindicado el el fichero de config
            $imagenNueva = $request
                ->file('imagen')
                ->store(config('filesystems.plantasImageDir'));

            //nos quedamos solo con el nombre del fichero para añadirlo a la BDD
            $datos['imagen'] = pathinfo($imagenNueva, PATHINFO_BASENAME);
        }

        //en caso de que nos pidan eliminar la imagen
        if ($request->filled('eliminarimagen') && $planta->imagen) {
            $datos['imagen'] = null;
            $aBorrar =
                config('filesystems.plantasImageDir') . '/' . $planta->imagen;
        }
        //al actualizar debemos tener en cuenta varias cosas:
        if ($planta->update($datos)) {
            //si todo va bien
            if (isset($aBorrar)) {
                Storage::delete($aBorrar);
            } //borramos foto antigua
        } else {
            //si algo falla
            if (isset($imagenNueva)) {
                Storage::delete($imagenNueva);
            } //borramos la foto
        }

        //carga la misma vista y  muestra el mensaje de exito
        return back()->with(
            'success',
            "Planta $planta->categoria $planta->tipo Actualizada"
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(PlantaDeleteRequest $request,Planta $planta){
        // autorizacion mediante policy
       /*  if ($request->user()->cant('delete',$planta))
        abort(401, 'no puedes borrar una moto que no es tuya'); */
 
        //recuerda la URL ANTERIOR para futuras redirecciones
        Session::put('returnTo', URL::previous());
       
        //muestra la vista de configuracion de eliminacion
        return view('plantas.delete', ['planta' => $planta]);
    }

    public function destroy(PlantaDeleteRequest $request, Planta $planta){
      
            $planta->delete();//soft delete (no podemos borrar la imagen aun)


            $redirect=Session::has('returnTo') &&  !Str::endsWith(Session::get('returnTo'), "/plantas/$planta->id") ? 
                        redirect(Session::get('returnTo')) ://por url
                        redirect()->route('plantas.index');//por nombre de ruta


         Session::remove('returnTo');
        
        //redirige a la lista de plantas
        return $redirect->with('success',"Planta $planta->categoria $planta->tipo Eliminada"
        );
        /*  abort(401, 'la firma de la URL no se pudo validar');

        $planta->delete(); 
        return redirect('plantas')->with(
            'success',
            "Planta $planta->categoria $planta->tipo eliminada"
        ); */
    } //
    //metodo que busca la planta
    public function search(Request $request)
    {
        $request->validate(['categoria' => 'max:16', 'tipo' => 'max:16']);
        //toma los cvalores que recupera de la planta= categoria y tipo
        $categoria = $request->input('categoria', '');
        $tipo = $request->input('tipo', '');
        //recupera los resultados, los añadimos a categoria y tipo al paginator
        //para que haga bien los enlaces y se mantenga el filtro al pasar de pagina
        $plantas = Planta::where('categoria', 'like', "%$categoria%")
            ->where('tipo', 'like', "%$tipo%")
            ->paginate(config('paginator.plantas'))
            ->appends(['categoria' => $categoria, 'tipo' => $tipo]);

        //retorna la vista de la lista con el filtro aplicado
        return view('plantas.list', [
            'plantas' => $plantas,
            'categoria' => $categoria,
            'tipo' => $tipo,
        ]);
    }
//metodo que restaura una moto borrada
//no podemos usar inyeccion de dependencias, al sere una moto
//borrada obtendriamos NULL

    public function restore(Request $request, int $id){

        //recuperar la planta borrada
        $planta=planta::withTrashed()->findOrFail($id);

        if($request->user()->cant('restore',$planta))
        throw new AuthorizationException('no tienes permiso');

        $planta->restore(); //restaura la p`lanta

        return back()->with('success',"Planta $planta->categoria $planta->tipo restaurada correctamente.");
    }


    //se eliminara la moto definitivamente
    public function purge(Request $request){

        //recuperar la planta borrada
        $planta=Planta::withTrashed()->findOrFail($request->input('planta_id'));

        //comprobar los permisos mediante las policy
        if($request->user()->cant('delete',$planta))
            throw new AuthorizationException('no tienes permiso para esta operacion');

            //si se consigue eliminar definitivamente la planta y tiene foto...
            if($planta->forceDelete() && $planta->imagen)

            //tambien borra la imagen
            Storage::delete(config('filesystems.plantasImageDir').'/'.$planta->imagen);

            return back()->with('success',"Planta $planta->categoria $planta->tipo eliminada definitivamente");
    }
}
