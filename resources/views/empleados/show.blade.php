<!-- Heredar la masterpage en esta vista -->
@extends('layouts.master')
<!-- contenido vistas -->
@section('contenido_vistas')
 <br>
<div class="card-deck">
    
        <div class="card" style="height:450px" >
            <div class="card-header" >
                Información del empleado:
            </div>
            <div class="card-body">
                <p class="card-title">{{ $empleado->FirstName}} {{$empleado->LastName}}</p>
                <p class="card-title">Cargo: {{ $empleado->Title}}</p>
                    <ul class="list-group list-group-flush">
                        @if($empleado->jefe_directo)
                            <li class="list-group-item"> Jefe Directo:
                                {{ $empleado->jefe_directo->FirstName}}
                                {{ $empleado->jefe_directo->LastName }}
                            </li>
                        @endif 
                            <li class="list-group-item">
                                Dirección: {{$empleado->Address}} 
                            </li>
                            <li class="list-group-item">
                                Ciudad: {{$empleado->City}} Pais: {{$empleado->Country}}
                            </li>
                            <li class="list-group-item">
                                Fecha Nacimiento: {{  $empleado->BirthDate->toFormattedDateString()   }}
                            </li> 
                            <li class="list-group-item">   
                                Fecha Contratación: {{  $empleado->HireDate->toFormattedDateString()   }}
                            </li>
                            <li class="list-group-item">   
                                Celular: {{  $empleado->Phone }}
                            </li>
                    </ul>
            </div>
        </div>
    <br>
        <div class="card" style="height:400px">
            <div class="card-header" >
                Información del Subalterno:
            </div>
            <div class="card-body">
                <p class="card-title">Subalternos</p>
                <ul class="list-group list-group-flush">
                    @if($empleado->subalternos->count()!==0)
                        @foreach ($empleado->subalternos as $subalterno)        
                            <li class="list-group-item">   
                            Nombre:  {{$subalterno->FirstName}} {{$subalterno->LastName}}
                            </li>
                        @endforeach
                        @else
                            <p class="text-danger">El empleado no tiene subalternos</p> 
                        @endif  
                </ul>    
            </div> 
        </div>
<br>
        <div class="card" style="width:100px" >
            <div class="card-header">
                Clientes a cargo
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @if($empleado->clientes->count() !== 0) 
                        @foreach($empleado->clientes as $clientes)
                            <li class="list-group-item">                                
                                Nombre: {{$clientes->FirstName}} {{$clientes->LastName}} 
                            </li>
                        @endforeach
                        @else 
                            <p class="text-danger d-inline-block">El empleado no tiene clientes</p>
                        @endif 
                </ul>                     
            </div> 
    </div>
</div>
@endsection