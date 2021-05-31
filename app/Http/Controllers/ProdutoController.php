<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    protected $produto = '';

    public function __construct(Produto $produto)
    {
        $this->produto = $produto;
    }


    public function index(Request $request)
    {
        $filter = $request->input('filter', '');
        $data = null;

        if($filter) {
            $filter = '%' . $filter . '%';

            $data = $this->produto->where(function($query) use ($filter){
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
            $data = $this->produto->get();
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
        $produto = new Produto($input);
        $produto->save();
        return response()->json(['data' => $produto]);
    }


    public function show(Produto $produto)
    {
        //
    }


    public function edit(Produto $produto)
    {
        return response()->json(['data' => $produto]);
    }


    public function update(Request $request, Produto $produto)
    {
        $input = $request->except(['_token','_method','datasheet','acessoadmin']);
        $produto->update($input);
        return response()->json(['data' => $produto]);
    }

    public function destroy($id)
    {
        $ids = explode(",", $id);
        Produto::destroy($ids);
        return response()->json(['status' => 'OK', 'ids' => $ids]);
    }
}
