<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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