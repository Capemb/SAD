<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('metas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('avaliacao_id')->constrained('avaliacoes')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('descricao', 255);
            $table->decimal('percentual_alcancado', 5, 2)->default(0); // 0-100
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('metas');
    }
};
