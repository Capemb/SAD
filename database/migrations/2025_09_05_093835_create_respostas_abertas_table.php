<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('respostas_abertas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('avaliacao_id')->constrained('avaliacoes')->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('pergunta');
            $table->text('resposta')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('respostas_abertas');
    }
};
