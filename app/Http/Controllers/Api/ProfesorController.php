<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profesor;
use Illuminate\Http\Request;

class ProfesorController extends Controller
{
    // LISTAR
    public function index()
    {
        $profesores = Profesor::orderBy(
            'id_profesor',
            'desc'
        )->get();

        return response()->json($profesores);
    }

    // GUARDAR
    public function store(Request $request)
    {
        $validated = $request->validate([

            'nombre' =>
                'required|string|max:255',

            'apellidos' =>
                'required|string|max:255',

            'fecha_nacimiento' =>
                'required|date',

            'dni' =>
                'required|string|max:8|unique:profesores,dni',

            'email' =>
                'required|email|unique:profesores,email',

            'especialidad' =>
                'required|string|max:255',

            'foto' =>
                'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Guardar imagen
        if ($request->hasFile('foto')) {

            $ruta = $request->file('foto')->store(
                'profesores',
                'public'
            );

            $validated['foto'] = $ruta;
        }

        $profesor = Profesor::create($validated);

        return response()->json($profesor, 201);
    }
}