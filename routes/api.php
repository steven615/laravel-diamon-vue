<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CondPgtoController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\FinanceiroController;
use App\Http\Controllers\FormaPgtoController;
use App\Http\Controllers\TipoMovController;
use App\Http\Controllers\TipoFreteController;
use App\Http\Controllers\UsersController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::resource('/product', ProductController::class);


    Route::resource('/pedidos', PedidoController::class)->middleware('cors');
    Route::get('/pedidoitens', [PedidoController::class, 'getpedidoitens']);
    Route::get('/pedidoeditar', [PedidoController::class, 'getpedido']);
    Route::get('/pedidoclientes', [PedidoController::class, 'getpedidoclientes']);
    Route::get('/pedidocliente', [PedidoController::class, 'getpedidocliente']);
    Route::get('/pedidotipomovs', [PedidoController::class, 'getpedidotipomovs']);
    Route::get('/pedidotipomov', [PedidoController::class, 'getpedidotipomov']);
    Route::get('/pedidocondpgtos', [PedidoController::class, 'getpedidocondpgtos']);
    Route::get('/pedidocondpgto', [PedidoController::class, 'getpedidocondpgto']);
    Route::get('/pedidoformapgtos', [PedidoController::class, 'getpedidoformapgtos']);
    Route::get('/pedidoformapgto', [PedidoController::class, 'getpedidoformapgto']);
    Route::get('/pedidofretes', [PedidoController::class, 'getpedidofretes']);
    Route::get('/pedidofrete', [PedidoController::class, 'getpedidofrete']);
    Route::get('/pedidoprodutos', [PedidoController::class, 'getpedidoprodutos']);
    Route::get('/pedidoproduto', [PedidoController::class, 'getpedidoproduto']);
    Route::get('/pedidoitem', [PedidoController::class, 'getpedidoitem']);
    Route::get('/pedidostop10', [PedidoController::class, 'gettop10']);

    Route::put('/pedidoitem/{id}', [PedidoController::class, 'updatepedidoitem']);
    Route::get('/pedidoitemdelete', [PedidoController::class, 'deletepedidoitem']);
    Route::get('/pedidocancela', [PedidoController::class, 'cancelapedido']);
    Route::get('/pedidoconfirma', [PedidoController::class, 'confirmapedido']);

    Route::resource('/activitylogs', ActivityLogController::class)->middleware('cors');
    Route::resource('/produtos', ProdutoController::class)->middleware('cors');
    Route::resource('/clientes', ClienteController::class)->middleware('cors');
    Route::resource('/condpgtos', CondPgtoController::class)->middleware('cors');
    Route::resource('/eventos', EventoController::class)->middleware('cors');
    Route::resource('/financeiros', FinanceiroController::class)->middleware('cors');
    Route::resource('/formapgtos', FormaPgtoController::class)->middleware('cors');
    Route::resource('/tipomovs', TipoMovController::class)->middleware('cors');
    Route::resource('/tipofretes', TipoFreteController::class)->middleware('cors');
    Route::resource('/users', UsersController::class)->middleware('cors');
});
