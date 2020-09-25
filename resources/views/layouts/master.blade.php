<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Brenda's Music</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Bootstrap core CSS -->
  <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- yield  para colocar la hoja de estilos-->

  @yield('estilos-particulares')

   <!-- Bootstrap core JavaScript -->

   <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <!-- <script src="{{ asset('jquery/jquery.slim.min.js')}}"></script>-->
  <!-- yield para librerias particulares dependientes de jquery -->
  @yield('j-deps')

  <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js')}}"></script>

</head>
<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light  static-top " style="background-color: #e3f2fd;">
    <div class="container">
    
    <a href="index.html"><img class="main-logo" src="https://image.flaticon.com/icons/png/512/26/26834.png" alt="" width="30" heigth="60" /></a>
      <a class="navbar-brand" href="#">Brenda's Music</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link"  href="{{url('empleados')}}">Empleados</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"  href="{{url('artistas')}}">Artistas</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">
    
     @yield('contenido_vistas')
    
  </div>

  

</body>

</html>
