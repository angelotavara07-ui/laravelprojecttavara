<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id('id_matricula');
            $table->foreignId('id_alumno')->constrained('alumnos', 'id_alumno')->onDelete('cascade');
            $table->foreignId('id_curso')->constrained('cursos', 'id_curso')->onDelete('cascade');
            $table->foreignId('id_profesor')->constrained('profesores', 'id_profesor')->onDelete('cascade');
            $table->foreignId('id_horario')->constrained('horarios', 'id_horario')->onDelete('cascade');
            $table->string('semestre', 20);
            $table->date('fecha_matricula');
            $table->decimal('nota_final', 5, 2)->nullable();
            $table->enum('estado',['aprobado', 'desaprobado', 'cursando'])->default('cursando');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matriculas');
    }
};
