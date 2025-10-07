<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('avaliacao_criterios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('avaliacao_id')->constrained('avaliacoes')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('criterio_id')->constrained('criterios')->cascadeOnDelete()->cascadeOnUpdate();
            $table->decimal('nota', 5, 2);
            $table->text('comentarios')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('avaliacao_criterios');
    }
};