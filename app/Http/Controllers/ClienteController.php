<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;


class ClienteController extends Controller
{
    protected $cliente = '';

    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }


    public function index(Request $request)
    {
        $filter = $request->input('filter', '');
        $data = null;

        if($filter) {
            $filter = '%' . $filter . '%';

            $data = $this->cliente->where(function($query) use ($filter){
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
            $data = $this->cliente->get();
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
        $cliente = new Cliente($input);
        $cliente->save();
        return response()->json(['data' => $cliente]);
    }


    public function show(Cliente $cliente)
    {
        //
    }


    public function edit(Cliente $cliente)
    {
        return response()->json(['data' => $cliente]);
    }


    public function update(Request $request, Cliente $cliente)
    {
        $input = $request->except([]);

        $cliente->update($input);
        return response()->json(['data' => $cliente]);
    }

    public function destroy($id)
    {
        $ids = explode(",", $id);
        Cliente::destroy($ids);
        return response()->json(['status' => 'OK', 'ids' => $ids]);
    }
}
