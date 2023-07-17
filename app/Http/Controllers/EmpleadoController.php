<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $datos['empleados']=Empleado::paginate(5);
        return view('empleado.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        //$datosEmpleado = request()->all();

        $campos = ['Name'=>'required|string|max:100',
                   'LastName'=>'required|string|max:100',
                   'Email'=>'required|email',
                   'Photo'=>'required|max:10000|mimes:jpeg, png, jpg'
                ];
        
        $mensaje=[
            'required'=>'El :attribute es requerido',
            'Photo.required'=>'La foto es requerida'
        ];

        $this->validate($request, $campos,$mensaje);
        $datosEmpleado = request()->except('_token');

        if($request-> hasFile('Photo')){
            $datosEmpleado['Photo']= $request->file('Photo')->store('uploads','public');
        }
        Empleado::insert($datosEmpleado);
        return redirect('empleado')-> with('message','Empleado agregado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $empleado= Empleado::findOrFail($id);
        return view('empleado.edit', compact('empleado') );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //

        $campos = ['Name'=>'required|string|max:100',
                   'LastName'=>'required|string|max:100',
                   'Email'=>'required|email',
                ];
        
        $mensaje=[
            'required'=>'El :attribute es requerido',
            'Photo.required'=>'La foto es requerida'
        ];

        if($request-> hasFile('Photo')){
            $campos =['Photo'=>'required|max:10000|mimes:jpeg, png, jpg'];
            $mensaje=[
                'Photo.required'=>'La foto es requerida'
            ];
        }

        $this->validate($request, $campos,$mensaje);

        $datosEmpleado = request()->except(['_token', '_method']);

        if($request-> hasFile('Photo')){
            $empleado= Empleado::findOrFail($id);
            Storage::delete('public/storage/'.$empleado->Photo);
            $datosEmpleado['Photo']= $request->file('Photo')->store('uploads','public');
        }

        Empleado::where('id','=',$id)->update($datosEmpleado);
        $empleado= Empleado::findOrFail($id);
        return redirect('empleado')-> with('message','Empleado editado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //

        $empleado= Empleado::findOrFail($id);

        if(Storage::delete('public/storage/'.$empleado->Photo))
            Empleado::destroy($id);
         return redirect('empleado')-> with('message','Empleado eliminado con exito');
    }
}
