<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('avaliacoes', function (Blueprint $table) {
        $table->dropForeign(['avaliador_id']);
        $table->dropForeign(['avaliado_id']);

        $table->foreign('avaliador_id')->references('id')->on('usuarios')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('avaliado_id')->references('id')->on('usuarios')->onDelete('cascade')->onUpdate('cascade');
    });
}

public function down(): void
{
    Schema::table('avaliacoes', function (Blueprint $table) {
        $table->dropForeign(['avaliador_id']);
        $table->dropForeign(['avaliado_id']);

        $table->foreign('avaliador_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('avaliado_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
    });
}

};
