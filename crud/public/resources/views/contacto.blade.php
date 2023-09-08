


@extends('layouts.master')
@section('titulo','Contactar con LaraPlantas')
@section('contenido')
    <div class="container row">
        <form  class="col-7 my-2 border p-4"
               enctype="multipart/form-data"
               method="POST"  
               action="{{route('contacto.email')}}">
    @csrf
    <div class="form-group row">
        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
        <input type="email" name="email" class="up form-control" id="inputEmail" 
        placeholder="Email" maxlength="255" required value="{{old('email')}}">
    </div>
    <div class="form-group row">
        <label for="inputNombre" class="col-sm-2 col-form-label">Nombre</label>
        <input type="text" name="nombre" class="up form-control" id="inputNombre" 
        placeholder="Nombre" maxlength="255" required value="{{old('nombre')}}">
    </div>
    <div class="form-group row">
        <label for="inputAsunto" class="col-sm-2 col-form-label">Asunto</label>
        <input type="text" name="asunto" class="up form-control" id="inputAsunto" 
        placeholder="Asunto" maxlength="255" required value="{{old('asunto')}}">
    </div>
    <div class="form-group row">
        <label for="inputMensaje" class="col-sm-2 col-form-label">Mensaje</label>
        <textarea name="mensaje" class="up form-control" id="inputMensaje" 
         maxlength="2048" required >{{old('mensaje')}}</textarea>
    </div>

        <form class="col-7 my-2 border p-4" enctype="multipart/form-data"
            mathod="POST" action="{{route('contacto.email')}}">

            <div class="form-group row my-4">
        <label for="inputFichero" class="form-label">Fichero (pdf):</label>
        <input name="fichero" type="file" class="form-control-file" 
        id="inputFichero" accept="application/pdf">
    </div>

    <div class="form-group row">
        <button type="submit" class="btn btn-success m-2 mt-5">Enviar</button>
        <button type="reset" class="btn btn-secondary m-2">Borrar</button>
    </div>


    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2985.6342614794967!2d2.055328176525794!3d41.55551558554894!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a493650ae03931%3A0xee4ac6c8e8372532!2sCIFO%20Sabadell-Terrassa!5e0!3m2!1ses!2ses!4v1688752925180!5m2!1ses!2ses" 
    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" 
    referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    @endsection

    @section('enlaces')
        @parent
        <a href="{{route('plantas.index')}}" class="btn btn-primary m-2">Huerto</a>
        @endsection