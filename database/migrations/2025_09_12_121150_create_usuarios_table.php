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
       // database/migrations/xxxx_xx_xx_xxxxxx_create_usuarios_table.php

        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('telefone')->nullable();
            $table->string('cargo')->nullable();
            $table->string('departamento')->nullable();
            $table->string('password');
            $table->enum('role', ['gestor', 'colaborador'])->default('colaborador'); // papel do usuário
            $table->unsignedBigInteger('gestor_id')->nullable(); // se for colaborador, referencia ao gestor
            $table->timestamps();

            $table->foreign('gestor_id')->references('id')->on('usuarios')->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
