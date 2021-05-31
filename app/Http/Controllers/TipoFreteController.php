<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoFrete;

class TipoFreteController extends Controller
{
    protected $tipofrete = '';

    public function __construct(TipoFrete $tipofrete)
    {
        $this->tipofrete = $tipofrete;
    }


    public function index(Request $request)
    {
        $filter = $request->input('filter', '');
        $data = null;

        if($filter) {
            $filter = '%' . $filter . '%';

            $data = $this->tipofrete->where(function($query) use ($filter){
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
            $data = $this->tipofrete->get();
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
        $tipofrete = new TipoFrete($input);
        $tipofrete->save();
        return response()->json(['data' => $tipofrete]);
    }


    public function show(TipoFrete $tipofrete)
    {
        //
    }


    public function edit(TipoFrete $tipofrete)
    {
        return response()->json(['data' => $tipofrete]);
    }


    public function update(Request $request, TipoFrete $tipofrete)
    {
        $input = $request->except([]);

        $tipofrete->update($input);
        return response()->json(['data' => $tipofrete]);
    }

    public function destroy($id)
    {
        $ids = explode(",", $id);
        TipoFrete::destroy($ids);
        return response()->json(['status' => 'OK', 'ids' => $ids]);
    }
}
