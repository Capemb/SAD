<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('avaliacoes', function (Blueprint $table) {
            $table->id();
           // $table->foreignId('avaliador_id')->constrained('usuarios')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('avaliador_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('avaliado_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('modulo_id')->constrained('modulos_avaliacao')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('data_avaliacao');
            $table->decimal('nota_final', 5, 2)->nullable();
            $table->text('comentarios')->nullable();
            $table->enum('relacao', ['gestor', 'par', 'subordinado'])->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('avaliacoes');
    }
};
