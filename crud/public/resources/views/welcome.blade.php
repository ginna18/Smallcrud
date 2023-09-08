
        @php($pagina='portada') 
        
        @extends('layouts.master')

        @section('titulo','Portada de Laraplantas')

        @section('contenido')

        <figure class="row mt-2 mb-2 col-10 offset-1">
            <img class="d-block w-100" 
                 alt="Plantas segun  tamaño" 
                 src="{{asset('images/plantas/planta0.png')}}">
            </figure>
            @endsection 

            @section('enlaces')

            @endsection
        <!-- </main> -->
        <!--parte inferior-->
    