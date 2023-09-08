
@extends('layouts.master')

@section('contenido')


            <div class="container">
                <h3 class="mt-4">plantas borradas</h3>
                <div class="text-start">{{ $plantas->links()}}</div>
            <table class="table table-striped table-bordered">
                <tr>
                    <th>ID</th>
                    <th>IMAGEN</th>
                    <th>CATEGORIA</th>
                    <th>TIPO</th>
                    <th>NOMBRE SILVESTRE</th>
                    <th>REGISTRO</th>
                    <th>USUARIO</th>
                    <th></th>
                    <th></th>
                </tr>
                @forelse ($plantas as $planta)
                <tr>
                    <td><b>#{{$planta->id}}</b></td>
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
                    <td>{{$planta->registro}}</td>
                    <td>{{$planta->user ? $planta->user->name : 'Desconocido'}}</td>


                    <td class="text-center">
                        <a href="{{route('plantas.restore',$planta->id)}}">
                            <button class="btn btn-success">restaurar</button>
                        </a>
                    </td>

                    
                    <td class="text-center">
                        <a onclick='if(confirm("¿estas seguro?"))
                                        this.nextElementSibling.sudmit();'>
                            <button class="btn btn-danger">Eliminar</button>
                        </a>
                        <form method="POST" class="d-none" action="{{route('plantas.purge')}}">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <input name="planta_id" type="hidden" value="{{$planta->id}}">
                        </form>
                    </td>
                </tr>
         @empty
         <tr>
            <td colspan="8" class="alert alert-danger">no hay motos borradas.</td>
         </tr>
         @endforelse
            </table>
            </div>
            @endsection
      