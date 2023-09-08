
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <style>
       
        </style>
    </head>
    <body class="container p-3">
        <header class="container row bg-light p-4 my-4">
            <figure class="img-fluid col-2">
                <img src="{{asset('images/logo/logo.png')}}" alt="logo">
            </figure>
            <h1 class="col-10">{{config('app.name')}}</h1>    
        </header>
        <main>
            <h2>Mensaje recibido: {{ $mensaje->asunto}}</h2>
            <p class="cursiva">De  {{ $mensaje->nombre}}
                <a href="mailto:{{$mensaje->email}}">&lt; {{ $mensaje->email}}&gt;</a>
        </p>
        <P>{{ $mensaje->mensaje}}</P>
        </main>
        <footer class="page-footer font-small p-4 my-4 bg-light">
            <p>aplicacion imitada por {{$autor}} como ejemeplo de clase.
                Desarrrollada haciendo uso de <b>LARAVEL</b> y <b>BOOSTRAP</b>.
            </p>
        </footer>
    </body>
</html>