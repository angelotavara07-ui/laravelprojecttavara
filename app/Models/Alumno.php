<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    // Tabla personalizada
    protected $table = 'alumnos';

    // Llave primaria personalizada
    protected $primaryKey = 'id_alumno';

    // Campos permitidos
    protected $fillable = [

        'nombre',

        'apellidos',

        'fecha_nacimiento',

        'dni',

        'direccion',

        'telefono',

        'email',

        'estado_matricula',

        'foto'
    ];
}