<?php

namespace App\Http\Controllers;

use App\Models\FormaPgto;
use App\Models\CondPgto;
use App\Models\TipoFrete;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\Produto;
use App\Models\TipoMov;
use Illuminate\Support\Facades\Log;


class PedidoController extends Controller
{
    protected $pedido = '';

    public function __construct(Pedido $pedido)
    {
        $this->pedido = $pedido;
    }


    public function index(Request $request)
    {
        $filter = $request->input('filter', '');
        $data = null;

        if($filter) {
            $filter = '%' . $filter . '%';

            $data = $this->pedido->where(function($query) use ($filter){
                $query->where('code', 'LIKE', $filter)
                    ->orWhere('name', 'LIKE', $filter)
                    ->orWhere('description', 'LIKE', $filter)
                    ->orWhere('image', 'LIKE', $filter)
                    ->orWhere('price', 'LIKE', $filter)
                    ->orWhere('category', 'LIKE', $filter)
                    ->orWhere('quantity', 'LIKE', $filter)
                    ->orWhere('inventoryStatus', 'LIKE', $filter)
                    ->orWhere('rating', 'LIKE', $filter);
            })
                ->get();
        } else {
            $data = $this->pedido::select('pedido.id','pedido.cliente','pedido.codigo','cliente.nome as nomecli','cliente.cidade','condpgto.descricao as desccond',
            'pedido.valor','pedido.peso','pedido.status')
            ->join('cliente','pedido.cliente','cliente.codigo')
            ->join('condpgto','pedido.condpgto','condpgto.codigo')
            ->get();
        }

        return response()->json(['data' => $data]);
    }


    public function gettop10(Request $request)
    {
        $filter = $request->input('filter', '');
            $data = $this->pedido::groupBy('cliente')
                ->selectRaw('cliente, max(nome) as nome, sum(valor) as valor')
                ->join('cliente','pedido.cliente','cliente.codigo')
                ->limit(10)
                ->orderBy('valor', 'desc')
                ->get();
        return response()->json(['data' => $data]);
    }


    public function getpedidoitens(Request $request)
    {
        $pedido_id = $request->input('pedido_id', '');
        $data = PedidoItem::select('pedidoitem.id','pedidoitem.produto','produto.descricao as descprod','pedidoitem.quant','pedidoitem.vlrunit','pedidoitem.vlrtotal')
            ->join('produto','pedidoitem.produto','produto.codigo')
            ->where('pedido_id','=',$pedido_id)
            ->get();
        return response()->json(['data' => $data]);
    }

    public function getpedidoitem(Request $request)
    {
        $id = $request->input('id', '');

        $data = PedidoItem::select('pedidoitem.id','pedidoitem.produto','produto.descricao as descprod','pedidoitem.quant','pedidoitem.vlrunit','pedidoitem.vlrtotal')
            ->join('produto','pedidoitem.produto','produto.codigo')
            ->where('pedidoitem.id', '=', $id)
            ->get()->first();

        return response()->json(['data' => $data]);
    }

    public function getpedidoprodutos()
    {
        $data = Produto::select('codigo', 'descricao', 'status', 'preco', 'saldo', 'categoria')
            ->get();
        return response()->json(['data' => $data]);
    }

    public function getpedidoproduto(Request $request)
    {
        $prodcod = $request->input('codigo', 0);
        $produto = Produto::where('codigo', '=', $prodcod)->get()->first();
        return response()->json(['data' => $produto]);
    }

    public function getpedidoclientes()
    {
        $data = Cliente::select('codigo', 'nome', 'cnpj', 'status', 'limite', 'cidade', 'estado')
            ->get();
        return response()->json(['data' => $data]);
    }

    public function getpedidocliente(Request $request)
    {
        $clicod = $request->input('codigo', 0);
        $cliente = Cliente::where('codigo', '=', $clicod)->get()->first();
        return response()->json(['data' => $cliente]);
    }


    public function getpedidotipomovs()
    {
        $data = TipoMov::select('codigo', 'descricao', 'status')->get();
        return response()->json(['data' => $data]);
    }

    public function getpedidotipomov(Request $request)
    {
        $clicod = $request->input('codigo', 0);
        $tipomov = TipoMov::where('codigo', '=', $clicod)->get()->first();
        return response()->json(['data' => $tipomov]);
    }

    public function getpedidocondpgtos()
    {
        $data = CondPgto::select('codigo', 'descricao', 'status')->get();
        return response()->json(['data' => $data]);
    }

    public function getpedidocondpgto(Request $request)
    {
        $codigo = $request->input('codigo', 0);
        $condpgto = CondPgto::where('codigo', '=', $codigo)->get()->first();
        return response()->json(['data' => $condpgto]);
    }

    public function getpedidoformapgtos()
    {
        $data = FormaPgto::select('codigo', 'descricao', 'status')->get();
        return response()->json(['data' => $data]);
    }

    public function getpedidoformapgto(Request $request)
    {
        $codigo = $request->input('codigo', 0);
        $formapgto = FormaPgto::where('codigo', '=', $codigo)->get()->first();
        return response()->json(['data' => $formapgto]);
    }

    public function getpedidofretes()
    {
        $data = TipoFrete::select('codigo', 'descricao', 'status')->get();
        return response()->json(['data' => $data]);
    }

    public function getpedidofrete(Request $request)
    {
        $codigo = $request->input('codigo', 0);
        $frete = TipoFrete::where('codigo', '=', $codigo)->get()->first();
        return response()->json(['data' => $frete]);
    }

    public function deletepedidoitem(Request $request)
    {
        $id = $request->input('id', 0);
        Log::debug($id);
        $pedidoitem = PedidoITem::where('id', '=', $id)->get()->first();
        PedidoITem::destroy($id);
        return response()->json(['data' => $pedidoitem]);
    }

    public function cancelapedido(Request $request)
    {
        $id = $request->input('id', 0);
        Log::debug($id);
        $pedido = Pedido::where('id', '=', $id)->get()->first();
        $pedido->update(array(
            'status' => 'X'
        ));

        return response()->json(['data' => $pedido]);
    }

    public function confirmapedido(Request $request)
    {
        $id = $request->input('id', 0);
        Log::debug($id);
        $pedido = Pedido::where('id', '=', $id)->get()->first();
        $pedido->update(array(
            'status' => 'C'
        ));

        return response()->json(['data' => $pedido]);
    }


    public function create()
    {

    }

    public function store(Request $request)
    {
        $input = $request->except([]);
        $pedido = new Pedido($input);
        $pedido->save();
        return response()->json(['data' => $pedido]);
    }


    public function show(Pedido $pedido)
    {
        //
    }


    public function edit(Pedido $pedido)
    {
        return response()->json(['data' => $pedido]);
    }



    public function getpedido(Request $request)
    {
        $pedidoid = $request->input('id', 0);
        $pedido = Pedido::where('id', '=', $pedidoid)->get()->first();

//        Log::debug($pedidoid);
//        Log::debug($pedido);

        return response()->json(['data' => $pedido]);
    }

    public function update(Request $request, Pedido $pedido)
    {
        $input = $request->except([]);
        $pedido->update($input);

        Log::debug('salvar');
        Log::debug($request);
        Log::debug($pedido);


        return response()->json(['data' => $pedido]);
    }

    public function updatePedidoItem(Request $request)
    {
        $input = $request->except(['descprod']);
        $pedido = Pedido::where('id', '=', $input['pedido_id'])->get()->first();

        Log::debug($input);
        Log::debug($pedido);
        if (isset($input['id'])){
            $pedidoitem = PedidoItem::where('id', '=', $input['id'])->get()->first();
            $pedidoitem->update($input);
        }else{
            $pedidoitem = $pedido->pedidoitem()->create($input);
        }
        return response()->json(['data' => $pedidoitem]);
    }

    public function destroy($id)
    {
        $ids = explode(",", $id);
        Pedido::destroy($ids);
        return response()->json(['status' => 'OK', 'ids' => $ids]);
    }
}
