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


// Api router
Route::middleware('auth:sanctum')->group(function () {
    Route::resource('/api/pedidos', PedidoController::class);
    Route::get('/api/pedidoitens', [PedidoController::class, 'getpedidoitens']);
    Route::get('/api/pedidoeditar', [PedidoController::class, 'getpedido']);
    Route::get('/api/pedidoclientes', [PedidoController::class, 'getpedidoclientes']);
    Route::get('/api/pedidocliente', [PedidoController::class, 'getpedidocliente']);
    Route::get('/api/pedidotipomovs', [PedidoController::class, 'getpedidotipomovs']);
    Route::get('/api/pedidotipomov', [PedidoController::class, 'getpedidotipomov']);
    Route::get('/api/pedidocondpgtos', [PedidoController::class, 'getpedidocondpgtos']);
    Route::get('/api/pedidocondpgto', [PedidoController::class, 'getpedidocondpgto']);
    Route::get('/api/pedidoformapgtos', [PedidoController::class, 'getpedidoformapgtos']);
    Route::get('/api/pedidoformapgto', [PedidoController::class, 'getpedidoformapgto']);
    Route::get('/api/pedidofretes', [PedidoController::class, 'getpedidofretes']);
    Route::get('/api/pedidofrete', [PedidoController::class, 'getpedidofrete']);
    Route::get('/api/pedidoprodutos', [PedidoController::class, 'getpedidoprodutos']);
    Route::get('/api/pedidoproduto', [PedidoController::class, 'getpedidoproduto']);
    Route::get('/api/pedidoitem', [PedidoController::class, 'getpedidoitem']);
    Route::get('/api/pedidostop10', [PedidoController::class, 'gettop10']);

    Route::put('/api/pedidoitem/{id}', [PedidoController::class, 'updatepedidoitem']);
    Route::get('/api/pedidoitemdelete', [PedidoController::class, 'deletepedidoitem']);
    Route::get('/api/pedidocancela', [PedidoController::class, 'cancelapedido']);
    Route::get('/api/pedidoconfirma', [PedidoController::class, 'confirmapedido']);

    Route::resource('/api/activitylogs', ActivityLogController::class);
    Route::resource('/api/produtos', ProdutoController::class);
    Route::resource('/api/clientes', ClienteController::class);
    Route::resource('/api/condpgtos', CondPgtoController::class);
    Route::resource('/api/eventos', EventoController::class);
    Route::resource('/api/financeiros', FinanceiroController::class);
    Route::resource('/api/formapgtos', FormaPgtoController::class);
    Route::resource('/api/tipomovs', TipoMovController::class);
    Route::resource('/api/tipofretes', TipoFreteController::class);
    Route::resource('/api/users', UsersController::class);
});