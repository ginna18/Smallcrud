@extends('layouts.master')
@section('titulo', 'Error 401')
@section('contenido')

        <div class="m-10">
            <div class="content" style="text-align: center">
                <div class="title mt-5" style="font-size: 3rem">
                    ERROR 401: NO ESTAS AUTORIZADO! :\
                </div>
                <div class="title mb-5" style="font-size: 2rem">
                    {{$exception->getMessage() }}
                </div>
            </div>
            
        </div>
    
@endsection

@section('enlaces')

        @parent
        <a href="{{route('plantas.index')}}" class="btn btn-primary m-2">HUERTO</a>
        @endsection