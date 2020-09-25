<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brenda's Music</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</head>
<body>
@extends('layouts.master')

<!-- contenido vistas -->
@section('contenido_vistas')
    <form class="form-horizontal" method="POST" action="{{ url('artistas/store')}}">
    @csrf
    <fieldset><br>
    <center>
    <div class="card col-md-6" >
        <div class="card-header">
            <!-- Form Name -->
            <legend>Nuevo Artista</legend>
        </div> 
        <div class="card-body">   
            <!-- Text input-->
            <div class="form-group">
            <label for="textinput">Nombre Artista/Banda</label>  
            <input id="textinput" name="nombre_artista" type="text" placeholder="Nombre" class="form-control input-md">
            <!--<strong class="alert alert-danger">{{$errors->first("nombre_artista")}}</strong>-->
            <br>
            @error('nombre_artista')
                <div class="alert alert-danger">{{$message}} </div>
            @enderror
            </div>
    
            <!-- Button -->
            <div class="form-group">
                    <a class="btn btn-danger btn-sm" href="{{url('artistas')}}">Volver</a>
                    <button type="submit" id="" name="" class="btn btn-success btn-sm">Enviar</button>
            </div>
            </div>
      </div>  
    </div>
    </center>
    </fieldset>
    <!--  Letrero de exito(solo va a salir si hay redireccionamiento)-->
    <!-- Existe la variable de sesion-->
    <!--@if(session("exito"))
        <p class="alert-success">¨{{session("exito")}}</p>
    @else
    hay errores de validacion
        @foreach($errors->all() as $error )
            <p class="alert-danger">{{$error}}</p>
        @endforeach-->
    @endif
    </form>
</body>
</html>
@endsection