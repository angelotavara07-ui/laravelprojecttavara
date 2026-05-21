<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Curso;

use Illuminate\Http\Request;

class CursoController extends Controller
{
    // LISTAR
    public function index()
    {
        $cursos = Curso::orderBy(
            'id_curso',
            'desc'
        )->get();

        return response()->json($cursos);
    }

    // GUARDAR
    public function store(Request $request)
    {
        $validated = $request->validate([

            'nombre_curso' =>
                'required|string|max:255',

            'creditos' =>
                'required|integer',

            'descripcion' =>
                'nullable|string',

            'foto' =>
                'nullable|image|max:2048'
        ]);

        // Imagen
        if ($request->hasFile('foto')) {

            $ruta = $request->file('foto')->store(
                'cursos',
                'public'
            );

            $validated['foto'] = $ruta;
        }

        $curso = Curso::create($validated);

        return response()->json($curso, 201);
    }
}