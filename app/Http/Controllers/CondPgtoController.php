<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CondPgto;

class CondPgtoController extends Controller
{
    protected $condpgto = '';

    public function __construct(CondPgto $condpgto)
    {
        $this->condpgto = $condpgto;
    }


    public function index(Request $request)
    {
        $filter = $request->input('filter', '');
        $data = null;

        if($filter) {
            $filter = '%' . $filter . '%';

            $data = $this->condpgto->where(function($query) use ($filter){
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
            $data = $this->condpgto->get();
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
        $condpgto = new CondPgto($input);
        $condpgto->save();
        return response()->json(['data' => $condpgto]);
    }


    public function show(CondPgto $condpgto)
    {
        //
    }


    public function edit(CondPgto $condpgto)
    {
        return response()->json(['data' => $condpgto]);
    }


    public function update(Request $request, CondPgto $condpgto)
    {
        $input = $request->except([]);

        $condpgto->update($input);
        return response()->json(['data' => $condpgto]);
    }

    public function destroy($id)
    {
        $ids = explode(",", $id);
        CondPgto::destroy($ids);
        return response()->json(['status' => 'OK', 'ids' => $ids]);
    }
}
