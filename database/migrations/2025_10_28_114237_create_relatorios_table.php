<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('relatorios', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('tipo')->nullable(); // ex: 'geral', 'colaborador'
            $table->foreignId('gerado_por')->constrained('usuarios')->onDelete('cascade');
            $table->string('ficheiro')->nullable(); // nome do ficheiro PDF salvo (opcional)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('relatorios');
    }
};
