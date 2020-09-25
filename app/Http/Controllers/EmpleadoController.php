<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleado;
use Illuminate\Support\Facades\Validator;


class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //Recuperar todos los empleados
       $empleados =\App\Empleado::paginate(6);
       //mostrar una vista con los empleados
       return view('empleados.index')->with("empleados", $empleados);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Seleccione los empleados cuyo id sea 1,2,6
        $managers = Empleado::find([1,2,6]);

        //seleccione los cargos sin repetir
        $cargos = Empleado::select("Title")->distinct()->get();

        //Mostrar Vista de regristrar o crear empleado
        return view("empleados.insert")
                ->with("jefes", $managers)
                ->with("cargos", $cargos);            
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //Validacion paso 1b: poner mensajes personalizados
         $mensajes=[
            'required'=>"El campo es obligatorio.",
            'min'=>"El campo debe tener 3 carácteres como mínimo",
            'max'=>"El campo debe tener 20 carácteres como máximo",
            'email'=>"El correo electrónico debe ser una dirección válida.",
            'regex'=>"Lo siento no puedes colocar números aquí."
            ];
    
            $validator = Validator::make($request->all(), [
                "jefe" => ["required"],
                "nombre" => ["required", 'min:3', 'max:20', 'regex:/^[\pL\s\-]+$/u' ],
                "apellido" => ["required", 'min:3', 'max:20',  'regex:/^[\pL\s\-]+$/u' ],
                //Colocar un dominio que si exista
                "email" => ["required", 'email:rfc,dns'],
                "direccion" => ["required"],
                "ciudad" => ["required"],
                "contrato" => ["required"],
                "nacimiento" => ["required"]
    
            ], $mensajes);
            
            //Validar
            if($validator->fails()){
                return redirect ("empleados/create")
                ->withErrors($validator);
            }
        //Crear objeto tipo Empleado; 
        $empleado = new Empleado();
        //asigar valores a los atributos
        $empleado->FirstName = $request->input("nombre");
        $empleado->LastName = $request->input("apellido");
        $empleado->Title = $request->input("cargo");
        $empleado->ReportsTo = $request->input("jefe");
        $empleado->BirthDate = $request->input("nacimiento");
        $empleado->HireDate = $request->input("contrato");
        $empleado->Email = $request->input("email");
        $empleado->Address = $request->input("direccion");
        $empleado->City = $request->input("ciudad");

        //registrar el objeto en base de datos 
        $empleado->save();
        echo "Empleado registrado satisfactoriamente";
    
        return redirect("empleados")->with("mensaje", "Empleado registrado");
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Mostrar detalle del empleado cuyo $id es el del parametro
        $empleado= \App\Empleado::with('subalternos')
                                ->with('clientes')
                                ->with('jefe_directo')
                                ->find($id);//SELECT * FROMEMPLOYEE WHERE EMPLOYEEID=$id
        
        //Enviar el objeto a la vista 
        return view('empleados.show')->with("empleado", $empleado);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Seleccionar el empleado a editar
        $empleado = Empleado::find($id);

        //Seleccione los empleados cuyo id sea 1,2,6
        $managers = Empleado::find([1,2,6]);

        //seleccione los cargos sin repetir
        $cargos = Empleado::select("Title")->distinct()->get();
    
        //llevar el empleado a editar a la vista
        return view("empleados.edit")->with("empleado", $empleado) 
                                     ->with("jefes", $managers)
                                     ->with("cargos", $cargos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        //Validacion paso 1b: poner mensajes personalizados
        $mensajes=[
        'required'=>"El campo es obligatorio.",
        'min'=>"El campo debe tener 3 carácteres como mínimo",
        'max'=>"El campo debe tener 20 carácteres como máximo",
        'email'=>"El correo electrónico debe ser una dirección válida.",
        'regex'=>"Lo siento no puedes colocar números aquí."
        ];

        $validator = Validator::make($request->all(), [
            "jefe" => ["required"],
            "nombre" => ["required", 'min:3', 'max:20', 'regex:/^[\pL\s\-]+$/u'],
            "apellido" => ["required", 'min:3', 'max:20', 'regex:/^[\pL\s\-]+$/u'],
            //Colocar un dominio valido 
            "email" => ["required", 'email:rfc,dns'],
            "direccion" => ["required"],
            "ciudad" => ["required"],
            "contrato" => ["required"],
            "nacimiento" => ["required"]

        ], $mensajes);

        
        
        //Validar
        if($validator->fails()){
            return redirect ("empleados/$id/edit")
            ->withErrors($validator);
        }

        //Seleccionar el empleado por id que se va a actualizar
        $empleado = Empleado::find($id);
        //Asignar atributos
        $empleado->FirstName = $request->input("nombre");
        $empleado->LastName = $request->input("apellido");
        $empleado->Title = $request->input("cargo");
        $empleado->ReportsTo = $request->input("jefe");
        $empleado->BirthDate = $request->input("nacimiento");
        $empleado->HireDate = $request->input("contrato");
        $empleado->Email = $request->input("email");
        $empleado->Address = $request->input("direccion");
        $empleado->City = $request->input("ciudad");
        //Guardar
        $empleado->save();
        return redirect("empleados")
        ->with( "mensaje" , "empleado actualizado correctamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
