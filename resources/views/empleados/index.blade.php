
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brenda's Music</title>
</head>
<body>
@extends('layouts.master')

<!-- contenido vistas -->
@section('contenido_vistas')

@if(session("mensaje"))
  <p class="alert-success">{{ session("mensaje") }}</p>
@endif
<br>
    <h3>Lista de Empleados</h3>
    <br>
    <a class="btn btn-primary btn-sm" href="{{url('empleados/create')}}">Nuevo Empleado</a>
    <br><br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <td>Nombre Completo</td>
                <td>Cargo</td>
                <td>Email</td>
                <td>Detalles</td>
                <td>Acciones</d>
            </tr>
        </thead>
        <tbody>
            @foreach($empleados as $empleado)
                <tr>
                    <td>{{$empleado->FirstName}}
                         <strong class="text-danger"> {{$empleado->LastName}}</strong></td>
                    <td>{{$empleado->Title}}</td>
                    <td>{{$empleado->Email}}</td>
                    <td>
                        <a href='{{url("empleados/$empleado->EmployeeId")}}' class="btn btn-success btn-sm">Ver Detalles</a>                   
                    </td>
                    <td>
                    <a href="{{  url('empleados/'.$empleado->EmployeeId.'/edit' )   }}" class="btn btn-info btn-sm"> 
                           Actualizar
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- TO DO: PONER EL PAGINADOR -->
    {{$empleados->links() }}
</body>
</html>
@endsection