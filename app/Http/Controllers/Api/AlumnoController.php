<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    public function index()
    {
        $alumnos = Alumno::orderBy(
            'id_alumno',
            'desc'
        )->get();

        return response()->json($alumnos);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([

            'nombre' => 'required|string|max:255',

            'apellidos' => 'required|string|max:255',

            'fecha_nacimiento' => 'required|date',

            'dni' => 'required|string|max:15|unique:alumnos,dni',

            'email' => 'required|email|unique:alumnos,email',

            'estado_matricula' =>
                'required|in:matriculado,inactivo',

            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        if ($request->hasFile('foto')) {

            $ruta = $request->file('foto')->store(
                'alumnos',
                'public'
            );
        
            $validated['foto'] = $ruta;
        }
        $alumno = Alumno::create($validated);

        return response()->json($alumno, 201);
    }
}