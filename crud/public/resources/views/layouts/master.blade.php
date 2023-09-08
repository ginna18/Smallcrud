<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Ejemplo CRUD con laravel - laraplantas">
    <title>{{config('app.name')}} - @yield('titulo')</title>
    <!--  CSS DE bootstrap  -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <script src="js/bootstrap.bundle.js"></script>
</head>
<body class="container p-3">

    @section('login')
    <ul class="navbar-nav ms-auto">
        <!-- Authentication Links -->
        @guest
            @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            @endif

            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest
    </ul>

    @show

  <!-- parte superior menu-->
  @section('navegacion')
  @php($pagina =$pagina ??'')
  <nav>
    <ul class="nav nav-pills my-3">
        <li class="nav-item mr-2">
            <a class="nav-link {{$pagina=='portada'?'active':''}}" 
            href="{{url('/')}}">Inicio</a>
        </li>
        
        <li class="nav-item mr-2">
            <a class="nav-link {{$pagina=='plantas.index'|| 
                                $pagina=='plantas.search'?'active':''}}"
            href="{{route('plantas.index')}}">Huerto</a>
        </li>
        @auth
       <li class="nav-item mr-2">
            <a class="nav-link {{$pagina=='home'?'active':''}}"
            href="{{route('home')}}">mis plantas</a>
        </li>

        <li class="nav-item mr-2">
            <a class="nav-link{{$pagina=='plantas.create'? 'active':''}}" 
            href="{{route('plantas.create')}}">Nueva planta</a>
        </li>
        @if(Auth::user()->hasRole('administrador'))
        <li class="nav-item mr-2">
            <a class="nav-link {{$pagina=='admin.deleted.plantas'?'active':''}}"
            href="{{route('admin.deleted.plantas')}}">Plantas borradas</a>
        </li>

        <li class="nav-item mr-2">
            <a class="nav-link 
            {{$pagina=='admin.users'|| $pagina=='admin.users.search' ? 'active':''}}"
            href="{{route('admin.users')}}">Gestion de usuarios</a>
        </li>
            @endif
        @endauth
        <li class="nav-item mr-2">
            <a class="nav-link {{$pagina=='contacto'?'active':''}}"
            href="{{route('contacto')}}">Contacto</a>
        </li>
        @guest
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
        </li>
        @endguest
    </ul>
</nav>
@show

<!-- fin menu nav-->
<!-- PARTE central-->
<h1 class="MY-2">SEGUNDO EJEMPLO DE CRUD CON LARAVEL</h1>

<main>
    <h2>@yield('titulo')</h2> 
{{--     @includeWhen(Session::has('success'), 'layouts.success')
    @includeWhen($errors->any(),'layouts.error')
 --}}
    @if(Session::has('success'))
    
     {{-- probando el nuevo componente --}}
     <x-alert type="success" message="{{Session::get('success')}}"/>
     @endif

     @if($errors->any())
         <x-alert type="danger" message="se han producido errores:">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
         </x-alert>    
                @endif
     {{-- <p>Contamos con un catalogo de {{$total}} plantas.</p> --}}
    
    @yield('contenido')
    
    <div class="btn-group" role="group" aria-label="links">
        @section('enlaces')

        <a href="{{url()->previous()}}" class="btn btn-primary m-2">Atrás</a>
       <a href="{{route('portada')}}" class="btn btn-primary m-2">Inicio</a> 
        
        @show

    </div>
</main>

<!-- PARTE INFERIOR  -->
@section('pie')
<footer class="page-footer font-small p-4 bg-light">
    <p>aplicacion imitada por {{$autor}} como ejemeplo de clase.
        Desarrrollada haciendo uso de <b>LARAVEL</b> y <b>BOOSTRAP</b>.
    </p>
</footer>
@show
</body>
</html>