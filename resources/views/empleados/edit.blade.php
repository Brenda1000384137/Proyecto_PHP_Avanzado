<!-- Heredar la masterpage en esta vista -->
@extends('layouts.master')

@section('estilos-particulares')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('j-deps')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $(function() {
    $(".datepicker").datepicker({
      dateFormat: 'yy-mm-dd'
    }).val();
  });
</script>
@endsection
<!--  Inicio de la vista-->

@section('contenido_vistas')
<form class="form-horizontal" method="POST" action="{{ url('empleados/'.$empleado->EmployeeId) }}">
  @method('PUT')
  @csrf
  <fieldset>
    <br>
      <div class="card" >
        <div class="card-header">
          <!-- Form Name -->
          <legend>Actualizar Empleado: {{ $empleado->FirstName }}, {{ $empleado->LastName}}</legend>
        </div>
        <div class="card-body">
          <div class="form-row">
            <!-- Text input-->
            <div class="form-group col-md-6">
              <label for="nombre">Nombre</label>
              <input id="textinput" value="{{ $empleado->FirstName }}" name="nombre" type="text" placeholder="" class="form-control input-md">
              <p class="text-danger">{{$errors->first('nombre')}}</p>
            </div>
            <!-- Text input-->
            <div class="form-group col-md-6">
              <label for="textinput">Apellido</label>
              <input id="textinput" value="{{ $empleado->LastName }}" name="apellido" type="text" placeholder="" class="form-control input-md">
              <p class="text-danger">{{$errors->first('apellido')}}</p>

            </div>
          </div>
          <div class="form-row">
            <!-- Select Basic -->
            <div class="form-group col-md-6">
              <label for="selectbasic">Cargo</label>
              <select id="selectbasic" name="cargo" class="form-control">
                @foreach ($cargos as $c)
                @if($empleado->Title === $c->Title)
                <option>{{ $c->Title}}</option>
                @else()
                <option>{{ $c->Title}}</option>
                @endif
                @endforeach
              </select>
              <p class="text-danger">{{$errors->first('cargo')}}</p>
            </div>
            <!-- Select Basic -->
            <div class="form-group col-md-6">
              <label for="selectbasic">Jefe Directo</label>
              <select id="selectbasic" name="jefe" class="form-control">
                @if( $empleado->jefe_directo()->count() === 0 )
                <option selected value=""> Seleccione Jefe directo</option>
                @foreach($jefes as $j)
                <option value="{{ $j->EmployeeId }}" selected>
                  {{$j->LastName}}, {{$j->FirstName}}
                </option>
                @endforeach
                @else
                <option value=""> Seleccione Jefe directo</option>
                @foreach($jefes as $j)
                @if( $j->EmployeeId === $empleado->jefe_directo()->first()->EmployeeId)
                <option selected value="{{ $j->EmployeeId }}" selected>
                  {{$j->LastName}}, {{$j->FirstName}}
                </option>
                @else
                <option value="{{ $j->EmployeeId }}">
                  {{$j->LastName}}, {{$j->FirstName}}
                </option>
                @endif
                @endforeach
                @endif
              </select>
              <p class="text-danger">{{$errors->first('jefe')}}</p>
            </div>
          </div>
          <div class="form-row">
            <!-- Text input-->
            <div class="form-group col-md-6">
              <label for="textinput">Fecha Contratación</label>
              <input value="{{ $empleado->HireDate->format('Y-m-d') }}" name="contrato" type="text" id="date" placeholder="" class="datepicker form-control input-md">
              <p class="text-danger">{{$errors->first('contrato')}}</p>
            </div>
            <!-- Text input-->
            <div class="form-group col-md-6">
              <label for="textinput">Fecha Nacimiento</label>
              <input value="{{ $empleado->BirthDate->format('Y-m-d') }}" name="nacimiento" type="text" id="datepicker" placeholder="" class="datepicker form-control input-md">
              <p class="text-danger">{{$errors->first('nacimiento')}}</p>
            </div>
          </div>
          <div class="form-row">
            <!-- Text input-->
            <div class="form-group col-md-4">
              <label for="textinput">Correo</label>
              <input value="{{ $empleado->Email }}" id="textinput" name="email" type="text" placeholder="" class="form-control input-md">
              <p class="text-danger">{{$errors->first('email')}}</p>

            </div>
            <!-- Text input-->
            <div class="form-group col-md-4">
              <label for="textinput">Dirección</label>
              <input value="{{ $empleado->Address }}" id="textinput" name="direccion" type="text" placeholder="" class="form-control input-md">
              <p class="text-danger">{{$errors->first('direccion')}}</p>
            </div>
            <!-- Select Basic -->
            <div class="form-group col-md-4">
              <label for="selectbasic">Ciudad</label>
              <input value="{{ $empleado->City }}" id="textinput" name="ciudad" type="text" placeholder="" class="form-control input-md">
              <p class="text-danger">{{$errors->first('ciudad')}}</p>
            </div>
          </div>
          <!-- Button (Double) -->
          <div class="form-group">
          <a class="btn btn-danger btn-sm" href="{{url('empleados')}}">Volver</a>
            <button id="button1id" name="button1id" class="btn btn-success btn-sm">Enviar</button>
          </div>
        </div>
      </div>  
    </div>
  </fieldset>
</form>

<!-- Fin de la vista -->
@endsection