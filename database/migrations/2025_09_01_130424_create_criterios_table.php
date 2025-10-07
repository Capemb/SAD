<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('criterios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('modulo_id')->constrained('modulos_avaliacao')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('nome', 100);
            $table->decimal('peso', 5, 2)->default(1.00);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('criterios');
    }
};
