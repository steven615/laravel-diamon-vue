<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Financeiro;

class FinanceiroController extends Controller
{
    protected $financeiro = '';

    public function __construct(Financeiro $financeiro)
    {
        $this->financeiro = $financeiro;
    }


    public function index(Request $request)
    {
        $filter = $request->input('filter', '');
        $data = null;

        if($filter) {
            $filter = '%' . $filter . '%';

            $data = $this->financeiro->where(function($query) use ($filter){
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
            $data = $this->financeiro->select('financeiro.id','financeiro.codigo','cliente.nome as nomecli',
                'financeiro.status','financeiro.emissao','financeiro.vencimento','financeiro.valor')
                ->join('cliente','financeiro.cliente','=','cliente.codigo')
                ->get();
        }

        return response()->json(['data' => $data]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $input = $request->except([]);
        $financeiro = new Financeiro($input);
        $financeiro->save();
        return response()->json(['data' => $financeiro]);
    }


    public function show(Financeiro $financeiro)
    {
        //
    }


    public function edit($id)
    {
        $data = $this->financeiro->select('financeiro.id','financeiro.codigo','cliente.nome as nomecli',
            'financeiro.status','financeiro.emissao','financeiro.vencimento','financeiro.valor')
            ->join('cliente','financeiro.cliente','=','cliente.codigo')
            ->where('financeiro.id','=',$id)
            ->get()->first();
        return response()->json(['data' => $data]);
    }


    public function update(Request $request, Financeiro $financeiro)
    {
        $input = $request->except([]);

        $financeiro->update($input);
        return response()->json(['data' => $financeiro]);
    }

    public function destroy($id)
    {
        $ids = explode(",", $id);
        Financeiro::destroy($ids);
        return response()->json(['status' => 'OK', 'ids' => $ids]);
    }
}
