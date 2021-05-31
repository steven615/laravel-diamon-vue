<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormaPgto;

class FormaPgtoController extends Controller
{
    protected $formapgto = '';

    public function __construct(FormaPgto $formapgto)
    {
        $this->formapgto = $formapgto;
    }


    public function index(Request $request)
    {
        $filter = $request->input('filter', '');
        $data = null;

        if($filter) {
            $filter = '%' . $filter . '%';

            $data = $this->formapgto->where(function($query) use ($filter){
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
            $data = $this->formapgto->get();
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
        $formapgto = new FormaPgto($input);
        $formapgto->save();
        return response()->json(['data' => $formapgto]);
    }


    public function show(FormaPgto $formapgto)
    {
        //
    }


    public function edit(FormaPgto $formapgto)
    {
        return response()->json(['data' => $formapgto]);
    }


    public function update(Request $request, FormaPgto $formapgto)
    {
        $input = $request->except([]);

        $formapgto->update($input);
        return response()->json(['data' => $formapgto]);
    }

    public function destroy($id)
    {
        $ids = explode(",", $id);
        FormaPgto::destroy($ids);
        return response()->json(['status' => 'OK', 'ids' => $ids]);
    }
}
