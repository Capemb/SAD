<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\LogoutController;
//use App\Http\Controllers\Api\Auth\ListarPerfilController;
//use App\Http\Controllers\Api\Auth\EscolherPerfilController;
//use App\Http\Controllers\Api\Auth\AssociarPerfilController;
//use App\Http\Controllers\Api\Auth\PerfilDisponivelController;
use App\Http\Controllers\Api\ModuloAvaliacao\CriarModuloAvaliacaoController;
use App\Http\Controllers\Api\ModuloAvaliacao\ListarModuloAvaliacaoController;
use App\Http\Controllers\Api\ModuloAvaliacao\MostrarModuloAvaliacaoController;
use App\Http\Controllers\Api\Criterios\AtualizarCriterioController;
use App\Http\Controllers\Api\Criterios\CriarCriterioController;
use App\Http\Controllers\Api\Criterios\EliminarCriterioController;
use App\Http\Controllers\Api\Criterios\ListarCriterioController;
use App\Http\Controllers\Api\ColaboradoresGestor\ActualizarCGController;
use App\Http\Controllers\Api\ColaboradoresGestor\CriarCGController;
use App\Http\Controllers\Api\ColaboradoresGestor\EliminarCGController;
use App\Http\Controllers\Api\ColaboradoresGestor\ListarCGController;
use App\Http\Controllers\Api\ColaboradoresGestor\LoginCGController;


use App\Http\Controllers\Api\Perfis\ListarPerfisController;
use App\Http\Controllers\Api\Perfis\AtribuirPermissaoPerfisController;
use App\Http\Controllers\Api\Perfis\RemoverPermissaoRoleController;
use App\Http\Controllers\Api\RolePermission\AtribuirPermissaoUsuarioController;
use App\Http\Controllers\Api\RolePErmission\RemoverPermissaoUsuarioController;
use App\Http\Controllers\Api\RolePermission\ListarTodasPermissoesController;
use App\Http\Controllers\Api\Ciclos\CriarCicloController;
use App\Http\Controllers\Api\Ciclos\ListarCiclosController;
use App\Http\Controllers\Api\Ciclos\MostrarCicloController;
use App\Http\Controllers\Api\Ciclos\ActualizarStatusCicloController;
use App\Http\Controllers\Api\Ciclos\ExcluirCicloController;
use App\Http\Controllers\Api\Avaliacao\CalcularNotaController;
use App\Http\Controllers\Api\Avaliacao\CriarAvaliacaoController;
use App\Http\Controllers\Api\Avaliacao\ListarAvaliacaoController;






Route::prefix('auth')->middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

Route::middleware('auth:sanctum')->get('/permissions', ListarTodasPermissoesController::class);

Route::middleware('auth:sanctum')->prefix('avaliacoes')->group(function(){
    Route::post('/criar', CriarAvaliacaoController::class);
    Route::get('/calcular/{id}',CalcularNotaController::class);
    Route::get('/listar',ListarAvaliacaoController::class);
});

Route::post('/usuarios/login-colaborador', LoginCGController::class);

Route::middleware('auth:sanctum')->prefix('criterios')->group(function(){
   Route::get('/listar-criterio/{modulo_id}', ListarCriterioController::class );
   Route::post('/criar-criterio',CriarCriterioController::class);
   Route::put('/atualizar-criterio/{criterio}', AtualizarCriterioController::class);
   Route::delete('/eliminar-criterio/{criterio}', EliminarCriterioController::class);
});

Route::middleware('auth:sanctum')->prefix('usuarios')->group(function(){
        Route::get('/listar-usuarios',ListarCGController::class);
        Route::post('/criar-usuarios',CriarCGController::class);
        Route::put('/atualizar-usuario/{id}',ActualizarCGController::class);
        Route::delete('/eliminar-usuario/{id}',EliminarCGController::class);
        Route::post('/{user}/permissions', AtribuirPermissaoUsuarioController::class);
        Route::delete('/{user}/permissions/{permission}', RemoverPermissaoUsuarioController::class);
    //Route::delete('/{user}/permissoes/{permission}', App\Http\Controllers\Api\Usuarios\RemoverPermissaoPerfilController::class);
});
Route::middleware('auth:sanctum')->prefix('perfis')->group(function(){
    Route::get('/', ListarPerfisController::class);
    Route::post('perfis/{role}/permissions', AtribuirPermissaoPerfisController::class);
    Route::delete('perfis/{role}/permissions/{permission}', RemoverPermissaoRoleController::class);
});


Route::prefix('auth')->group(function () {
    Route::post('/login', LoginController::class);
    Route::post('/register', RegisterController::class);
   // Route::get('/perfis', ListarPerfilController::class)->middleware('auth:sanctum');
   // Route::post('/perfis/escolher', EscolherPerfilController::class)->middleware('auth:sanctum');
     Route::post('/logout', LogoutController::class)->middleware('auth:sanctum');
   // Route::post('/perfis/associar', AssociarPerfilController::class)->middleware('auth:sanctum');
  //  Route::get('/perfis-disponiveis', PerfilDisponivelController::class)->middleware('auth:sanctum');
});


Route::prefix('modulos-avaliacao')->middleware('auth:sanctum')->group(function () {
    Route::post('/criar-modulo', CriarModuloAvaliacaoController::class);
    Route::get('/listar-modulo', ListarModuloAvaliacaoController::class);
    Route::get('mostrar-modulo/{id}', MostrarModuloAvaliacaoController::class);
});

Route::prefix('ciclos')->middleware('auth:sanctum')->group(function(){
    Route::get('/', ListarCiclosController::class);
    Route::post('/', CriarCicloController::class);
    Route::get('{id}', MostrarCicloController::class);
    Route::patch('{id}/status', ActualizarStatusCicloController::class);
    Route::delete('{id}', ExcluirCicloController::class);
});

