<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use Illuminate\Http\Request;
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
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return Inertia::render('Welcome', [
    //     'canLogin' => Route::has('login'),
    //     'canRegister' => Route::has('register'),
    //     'laravelVersion' => Application::VERSION,
    //     'phpVersion' => PHP_VERSION,
    // ]);
    return redirect('/dashboard');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/activitylogs', function () {
        return Inertia::render('activitylogs/ActivityLogs', ['breadcrumb' => ['parent' => 'Administrativo', 'label' => "Log's de Atividade"],]);
    })->name('activitylogs');

    Route::get('/dashboard', function () {
        return Inertia::render('dashboard/DashBoardB', ['breadcrumb' => ['parent' => 'Dashboard', 'label' => "Dashboard"],]);
    })->name('dashboard');

    Route::get('/clientes', function () {
        return Inertia::render('clientes/Clientes', ['breadcrumb' => ['parent' => 'Cadastro', 'label' => "Clientes"],]);
    })->name('clientes');

    Route::get('/calendario', function () {
        return Inertia::render('calendario/Calendario', ['breadcrumb' => ['parent' => 'Administrativo', 'label' => "Calendário"],]);
    })->name('calendario');

    Route::get('/condpgtos', function () {
        return Inertia::render('condpgtos/CondPgtos', ['breadcrumb' => ['parent' => 'Cadastro', 'label' => "Condições de Pagamento"],]);
    })->name('condpgtos');

    Route::get('/financeiros', function () {
        return Inertia::render('financeiros/Financeiros',['breadcrumb' =>['parent' => 'Cadastro', 'label' => "Financeiro"],]);
    })->name('financeiros');

    Route::get('/formapgtos', function () {
        return Inertia::render('formapgtos/FormaPgtos', ['breadcrumb' => ['parent' => 'Cadastro', 'label' => "Formas de Pagamento"],]);
    })->name('formapgtos');

    Route::get('/pedidos', function () {
        return Inertia::render('pedidos/Pedidos', ['breadcrumb' => ['parent' => 'Cadastro', 'label' => "Pedidos"],]);
    })->name('pedidos');

    Route::get('/pedidoeditar/:id', function () {
        return Inertia::render('pedidos/PedidoEditar', ['breadcrumb' => ['parent' => 'Cadastro', 'label' => "Editar Pedidos"],]);
    })->name('pedidoeditar');

    Route::get('/produtos', function () {
        return Inertia::render('produtos/Produtos', ['breadcrumb' => ['parent' => 'Cadastro', 'label' => "Produtos"],]);
    })->name('produtos');

    Route::get('/questioeditar/:id', function () {
        return Inertia::render('clientes/QuestioSucesso',['breadcrumb' => ['parent' => 'Cadastro', 'label' => "Editar Questionário"],]);
    })->name('questioeditar');

    Route::get('/tipomovs', function () {
        return Inertia::render('tipomovs/TipoMovs', ['breadcrumb' => ['parent' => 'Cadastro', 'label' => "Tipos de Movimento"],]);
    })->name('tipomovs');

    Route::get('/tipofretes', function () {
        return Inertia::render('tipofretes/TipoFretes', ['breadcrumb' => ['parent' => 'Cadastro', 'label' => "Tipos de Movimento"],]);
    })->name('tipofretes');

    Route::get('/users', function () {
        return Inertia::render('users/Users', ['breadcrumb' => ['parent' => 'Administrativo', 'label' => "Usuários"],]);
    })->name('users');

    Route::get('/:pathMatch(.*)*', function () {
        return Inertia::render('pages/NotFound');
    })->name('not-found');
});


Route::middleware('auth:sanctum')->group(function () {
    Route::resource('/pedidos', PedidoController::class);
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

    Route::resource('/activitylogs', ActivityLogController::class);
    Route::resource('/produtos', ProdutoController::class);
    Route::resource('/clientes', ClienteController::class);
    Route::resource('/condpgtos', CondPgtoController::class);
    Route::resource('/eventos', EventoController::class);
    Route::resource('/financeiros', FinanceiroController::class);
    Route::resource('/formapgtos', FormaPgtoController::class);
    Route::resource('/tipomovs', TipoMovController::class);
    Route::resource('/tipofretes', TipoFreteController::class);
    Route::resource('/users', UsersController::class);
});