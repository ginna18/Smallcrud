
        <!--TITULO DE LA PAGINA-->
        
@extends('layouts.master')
@section('login')
@section('contenido')

<h2> Mis plantas</h2>
        
<table class="table table-striped table-bordered">
    @forelse($plantas as $planta)
    @if($loop->first)
    <tr>
        <th>ID</th>
        <th>IMAGEN</th>
        <th>CATEGORIA</th>
        <th>TIPO</th>
        <th>NOMBRE SILVESTRE</th>
        <th>NOMBRE CIENTIFICO</th>
        <th>DESCRIPCION</th>
        <th>ALTURA</th>
        <th>REGISTRADA</th>
        <th>REGISTRO</th>
        <th>COLOR</th>
        <th>OPERACIONES</th>
    </tr>
    @endif
    <tr>
        <td>{{$planta->id}}</td>
        <td class="text-center" style="max-width :80px">
        <img class="rounded" style="max-width: 80%"
            alt="Imagen de {{$planta->categoria}} {{$planta->tipo}}"
            title="Imagen de {{$planta->categoria}} {{$planta->tipo}}"
            src="{{
                $planta->imagen?
                asset('storage/'.config('filesystems.plantasImageDir')).'/'.$planta->imagen:
                asset('storage/'.config('filesystems.plantasImageDir')).'/default.jpg'
            }}">
        </td>
        <td>{{$planta->categoria}}</td>
        <td>{{$planta->tipo}}</td>
        <td>{{$planta->nombres}}</td>
        <td>{{$planta->nombrec}}</td>
        <td>{{$planta->descripcion}}</td>
        <td>{{$planta->altura}}</td>
        <td>{{$planta->registrada}}</td>
        <td>{{$planta->registro}}</td>
        <td>{{$planta->color}}</td>
        <td class="text-center">
            <a href="{{route('plantas.show',$planta->id)}}">
                <img height="20" width="20" src="{{asset('images/buttons/show.png')}}"
                alt="Ver detalles" title="Ver detalles"></a>
            
                @if(Auth::user()->can('update',$planta))
                <a href="{{route('plantas.edit',$planta->id)}}">
                <img height="20" width="20" src="{{asset('images/buttons/update.png')}}"
                alt="Modificar" title="Modificar"></a>
                @endif

                @if(Auth::user()->can('delete',$planta))
                <a href="{{route('plantas.delete',$planta->id)}}">
                <img height="20" width="20" src="{{asset('images/buttons/delete.png')}}"
                alt="Borrar" title="Borrar"></a>
                @endif
     
        </td>
    </tr>
    @endforeach
    <tr>
        <td colspan="7">
            Mostrando {{sizeof($plantas)}}
            de {{$plantas->total()}}.
        </td>
    </tr>
</table>



@if(count($deletedPlantas))
<h3 class="mt-4"> Mis plantas borradas</h3>       
<table class="table table-striped table-bordered">
    <tr>
        <th>ID</th>
        <th>IMAGEN</th>
        <th>CATEGORIA</th>
        <th>TIPO</th>
        <th>NOMBRE SILVESTRE</th>
       {{--  <th></th>
        <th></th>
        <th></th>
        <th></th> --}}
        <th>REGISTRO</th>
        {{-- <th></th> --}}
        {{-- <th>OPERACIONES</th> --}}
    </tr>
    @foreach($deletedPlantas as $planta)
    <tr>
        <td><b>#{{$planta->id}}</b></td>
        <td class="text-center" style="max-width :80px">
        <img class="rounded" style="max-width: 80%"
            alt="Imagen de {{$planta->categoria}} {{$planta->tipo}}"
            title="Imagen de {{$planta->categoria}} {{$planta->tipo}}"
            src="{{$planta->imagen?
                asset('storage/'.config('filesystems.plantasImageDir')).'/'.$planta->imagen:
                asset('storage/'.config('filesystems.plantasImageDir')).'/default.jpg'
            }}">
        </td>
        <td>{{$planta->categoria}}</td>
        <td>{{$planta->tipo}}</td>
        <td>{{$planta->nombres}}</td>
       {{--  <td>{{$planta->nombrec}}</td>
        <td>{{$planta->descripcion}}</td>
        <td>{{$planta->altura}}</td>
        <td>{{$planta->registrada}}</td> --}}
        <td>{{$planta->registro}}</td>
        {{-- <td>{{$planta->color}}</td>
         --}}
        <td class="text-center">
            <a href="{{route('plantas.restore',$planta->id)}}">
                <button class="btn btn-success">Restaurar</button>
              </a>
        </td>

        <td class="text-center">
            <a onclick='
                if(confirm("¿Estas seguro?"))
                    this.nextElementSibling.submit();'>
                    <button class="btn btn-danger">Eliminar</button>
            </a>
            <form method="POST" action="{{route('plantas.purge')}}">
                @csrf
                <input name="_method" type="hidden" value="DELETE">
                <input name="planta.id" type="hidden" value="{{$planta->id}}">
         
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endif








{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('home') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('estas conectado!') }}
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
</body>
</html>