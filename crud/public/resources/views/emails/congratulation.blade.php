
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <style>
       /* truco para usar Boostrap en un email */
   /*     @php
       include 'css/bootstrap.min.css';
       @endphp */
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
            <h1>FELICIDADES</h1>
            <h2>HAS PUBLICADO tu primera planta en laraplantas</h2>
            <p>tu nueva planta {{$planta->categoria.''.$planta->tipo.''.$planta->nombres}}
            ya aparece en los resultados.</p>
            <p>sigue asi, estas colaborando para que laraplantas se convierta
                en la primera red de usuarios
            </p>
            
        </main>
        <footer class="page-footer font-small p-4 my-4 bg-light">
            <p>aplicacion imitada por {{$autor}} como ejemeplo de clase.
                Desarrrollada haciendo uso de <b>LARAVEL</b> y <b>BOOSTRAP</b>.
            </p>
        </footer>
    </body>
</html>