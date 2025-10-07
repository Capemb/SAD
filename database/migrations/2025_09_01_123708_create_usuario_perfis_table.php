<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuario_perfis', function (Blueprint $table) {
            $table->foreignId('usuario_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            //$table->foreignId('usuario_id')->constrained('usuarios')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('perfil_id')->constrained('perfis')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamp('atribuido_em')->useCurrent();
            $table->primary(['usuario_id', 'perfil_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuario_perfis');
    }
};
