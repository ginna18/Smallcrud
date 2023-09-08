    @extends('layouts.master')

     @section('titulo',"confirmacion de borrado de $planta->categoria $planta->tipo")

     @section('contenido')
     <form method="POST" class="my-2 border p-5" 
     action="{{URL::temporarysignedRoute('plantas.destroy', now()->addMinutes(1),$planta->id)}}">
         
         @csrf

         <input name="_method" type="hidden" value="DELETE">

         <figure>
             <figcaption>Imagen actual</figcaption>
             <img class="rounded" style="max-width: 400px"
             alt="Imagen de {{$planta->categoria}} {{$planta->tipo}}"
             title="Imagen de {{$planta->categoria}} {{$planta->tipo}}"
             src="{{$planta->imagen?
                 asset('storage/'.config('filesystems.plantasImageDir')).'/'.$planta->imagen:
                 asset('storage/'.config('filesystems.plantasImageDir')).'/default.jpg'}}">

         </figure>

         <label for="confirmdelete"> confirmar el borrado de 
             {{"$planta->categoria $planta->tipo"}}:</label>
             
         <input type="submit" alt="Borrar" title="Borrar" 
         class="btn btn-danger m-4" value="Borrar" id="confirmdelete">
     </form>
@endsection

@section('enlaces')

    @parent 
                <a href="{{route('plantas.index')}}" class="btn btn-primary m-2"> Huerto</a>
                <a href="{{route('plantas.show',$planta->id)}}" class="btn btn-primary m-2"> 
                Regresar a detalles de la planta</a>
   

 @endsection