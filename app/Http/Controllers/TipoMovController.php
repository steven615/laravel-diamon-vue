<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoMov;

class TipoMovController extends Controller
{
    protected $tipomov = '';

    public function __construct(TipoMov $tipomov)
    {
        $this->tipomov = $tipomov;
    }


    public function index(Request $request)
    {
        $filter = $request->input('filter', '');
        $data = null;

        if($filter) {
            $filter = '%' . $filter . '%';

            $data = $this->tipomov->where(function($query) use ($filter){
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
            $data = $this->tipomov->get();
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
        $tipomov = new TipoMov($input);
        $tipomov->save();
        return response()->json(['data' => $tipomov]);
    }


    public function show(TipoMov $tipomov)
    {
        //
    }


    public function edit(TipoMov $tipomov)
    {
        return response()->json(['data' => $tipomov]);
    }


    public function update(Request $request, TipoMov $tipomov)
    {
        $input = $request->except([]);

        $tipomov->update($input);
        return response()->json(['data' => $tipomov]);
    }

    public function destroy($id)
    {
        $ids = explode(",", $id);
        TipoMov::destroy($ids);
        return response()->json(['status' => 'OK', 'ids' => $ids]);
    }
}
