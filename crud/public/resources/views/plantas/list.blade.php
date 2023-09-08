@extends('layouts.master')

@section('titulo','Lista de plantas')

@section('contenido')
            
      <!-- formulario de busqueda de plantas-->
      
      <form method="GET" class="col-6 row" enctype=“multipart/form-data”
                    action="{{route('plantas.search')}}">

                    <input name="categoria" type="text" class="col form-control mr-2 mb-2"
                     placeholder="Categoria" maxlength="16"
                     value="{{ $categoria ?? ''}}">

                    <input name="tipo" type="text" class="col form-control mr-2 mb-2"
                    placeholder="Tipo" maxlength="16"
                    value="{{ $tipo ?? ''}}">

                    <button type="submit" class="col btn btn-primary mr-2 mb-2">Buscar</button>

                    <a href="{{route('plantas.index')}}">
                            <button type="button" class="col btn btn-primary mb-2">
                                Quitar filtro</button>
                            </a>
                </form>
  <!--fin formulario-->

            <h2> listado de plantas</h2>
            @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
            @endif
            <div class="row">
                <div class="col-6 text-star"> {{$plantas->links()}}</div>
                <div class="col-6 text-end">
                    <p>nueva planta<a href="{{route('plantas.create')}}"
                        class="btn btn-success ml-2">+</a>
                </p>
                </div>

          
            </div>
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
                    {{-- <th>DESCRIPCION</th> --}}
                    <th>ALTURA</th>
                    <th>REGISTRADA</th>
                    <th>REGISTRO</th>
                    <th>COLOR</th>
                    <th>OPERACIONES</th>
                </tr>
                @endif

                {{-- @foreach ($plantas as $planta) --}}
                

                
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
                    {{-- <td>{{$planta->descripcion}}</td> --}}
                    <td>{{$planta->altura}}</td>
                    <td>{{$planta->registrada}}</td>
                    <td>{{$planta->registro}}</td>
                    <td>{{$planta->color}}</td>
                    <td class="text-center">
                        <a href="{{route('plantas.show',$planta->id)}}">
                            <img height="20" width="20" src="{{asset('images/buttons/show.png')}}"
                            alt="Ver detalles" title="Ver detalles"></a>
                        @auth
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
                        @endauth
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
            <div class="btn-group" role=" group" label="links">
            <a href="{{url('/')}}" class="btn btn-primary mr-2">Inicio</a>
            </div>
            </div>

            
@endsection
