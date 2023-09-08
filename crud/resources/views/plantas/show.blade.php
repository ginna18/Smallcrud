
@extends('layouts.master')

@section('titulo','Lista de plantas')

@section('contenido')
            

            <h2> Detalles de la planta</h2>

            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
            @endif

            <table class="table table-striped table-bordered">
                <tr>
                    <td>ID</td>
                    <td>{{$planta->id}}</td>
                </tr>
                <tr>
                    <td>Categoria</td>
                    <td>{{$planta->categoria}}</td>
                </tr>

                <tr>
                    <td>tipo</td>
                    <td>{{$planta->tipo}}</td>
                </tr>
                <tr>
                    <td>NOMBRE SILVESTRE</td>
                    <td>{{$planta->nombres}}</td>
                </tr>

                <tr>
                    <td>NOMBRE CIENTIFICO</td>
                    <td>{{$planta->nombrec}}</td>
                </tr>

                <tr>
                    <td>DESCRIPCION</td>
                    <td>{{$planta->descripcion}}</td>
                </tr>

                <tr>
                    <td>CREADOR</td>
                    <td>{{$planta->user? $planta->user->name: 'sin creador'}}</td>
                </tr>
               
                <tr>
                    <td>ALTURA</td>
                    <td>{{$planta->altura}}</td>
                </tr>

                    <tr>
                        <td>REGISTRADA</td>
                        <td>{{$planta->registrada? 'SI' : 'NO'}}</td>
                    </tr>
                    @if($planta->registrada)
                    <tr>
                        <td>REGISTRO</td>
                        <td>{{$planta->registro}}</td>
                    </tr>
                    @endif

                    @if ($planta->color)
                    <tr>
                        <td>COLOR</td>
                        <td style="background-color:{{$planta->color}}">{{$planta->color}}</td>
                    </tr>
                        
                    @endif
                <tr>
                    <td>IMAGEN</td>
                    <td class="text-start">
                        <img class="rounded" style="max-width: 400px"
                        alt="Imagen de {{$planta->categoria}} {{$planta->tipo}}"
                        title="Imagen de {{$planta->categoria}} {{$planta->tipo}}"
                        src="{{$planta->imagen?
                            asset('storage/'.config('filesystems.plantasImageDir')).'/'.$planta->imagen:
                            asset('storage/'.config('filesystems.plantasImageDir')).'/default.jpg'
                        }}">
                </td>
                </tr>
                </table>
                
            
            
            <div class="text-end my-3">
                <div class="btn-group mx-2">
                    <a class="mx-2" href="{{route('plantas.edit',$planta->id)}}">
                        <img height="40" width="40" src="{{asset('images/buttons/update.png')}}"
                        alt="Modificar" title="Modificar">
                    </a>
                    <a class="mx-2" href="{{route('plantas.delete',$planta->id)}}">
                        <img height="40" width="40" src="{{asset('images/buttons/delete.png')}}"
                        alt="Borrar" title="Borrar">
                    </a>
                </div>
            </div>
            <div class="btn-group" role="group" arial-label="links">
                <a href="{{url('/')}}" class="btn btn-primary m-2">Inicio</a>
                <a href="{{route('plantas.index')}}" class="btn btn-primary m-2">huerto</a>
            </div>
           
            
@endsection