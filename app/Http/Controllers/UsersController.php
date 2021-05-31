<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
    protected $user = '';

    public function __construct(User $user)
    {
        $this->user = $user;
    }


    public function index(Request $request)
    {
        $filter = $request->input('filter', '');
        $data = null;

        if($filter) {
            $filter = '%' . $filter . '%';

            $data = $this->user->where(function($query) use ($filter){
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
            $data = $this->user->get();
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
        $user = new User($input);
        $user->save();
        return response()->json(['data' => $user]);
    }


    public function show(User $user)
    {
        //
    }


    public function edit(User $user)
    {
        return response()->json(['data' => $user]);
    }


    public function update(Request $request, User $user)
    {
        $input = $request->except([]);

        Log::debug($input);

        $user->update($input);
        return response()->json(['data' => $user]);
    }

    public function destroy($id)
    {
        $ids = explode(",", $id);
        User::destroy($ids);
        return response()->json(['status' => 'OK', 'ids' => $ids]);
    }
}
