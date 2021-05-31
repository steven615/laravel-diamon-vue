<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;

class EventoController extends Controller
{
    protected $evento = '';

    public function __construct(Evento $evento)
    {
        $this->evento = $evento;
    }


    public function index(Request $request)
    {
        $filter = $request->input('filter', '');
        $data = null;

        if($filter) {
            $filter = '%' . $filter . '%';

            $data = $this->evento->where(function($query) use ($filter){
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
            $data = $this->evento->get();
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
        $evento = new Evento($input);
        $evento->save();
        return response()->json(['data' => $evento]);
    }


    public function show(Evento $evento)
    {
        //
    }


    public function edit(Evento $evento)
    {
        return response()->json(['data' => $evento]);
    }


    public function update(Request $request, Evento $evento)
    {
        $input = $request->except([]);

        $evento->update($input);
        return response()->json(['data' => $evento]);
    }

    public function destroy($id)
    {
        $ids = explode(",", $id);
        Evento::destroy($ids);
        return response()->json(['status' => 'OK', 'ids' => $ids]);
    }
}
