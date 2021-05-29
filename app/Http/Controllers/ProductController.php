<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    protected $product = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }


    /**
     * Display a listing of the resource.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->input('filter', '');
        $data = null;

        if($filter) {
            $filter = '%' . $filter . '%';

            $data = $this->product->where(function($query) use ($filter){
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
            $data = $this->product->get();
        }
        
        return response()->json(['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product;

        $product->name = $request->input('name');
        $product->code = $request->input('code');
        $product->description = $request->input('description', '');
        $product->image = $request->input('image', 'bamboo-watch.jpg');
        $product->price = $request->input('price', 0);
        $product->category = $request->input('category', '');
        $product->quantity = $request->input('quantity', 0);
        $product->inventoryStatus = $request->input('inventoryStatus', 'INSTOCK');
        $product->rating = $request->input('rating', 0);
        $product->save();

        return response()->json(['data' => $product]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return response()->json(['data' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $input = [
            'name' => $request->input('name'),
            'code' => $request->input('code'),
            'description' => $request->input('description', ''),
            'image' => $request->input('image', 'bamboo-watch.jpg'),
            'price' => $request->input('price', 0),
            'category' => $request->input('category', ''),
            'quantity' => $request->input('quantity', 0),
            'inventoryStatus' => $request->input('inventoryStatus', 'INSTOCK'),
            'rating' => $request->input('rating', 0)
        ];
        
        $product->update($input);
        return response()->json(['data' => $product]);
    }

    /**
     * Remove the multiple resource from storage.
     *
     * @param  array  $ids
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ids = explode(",", $id);
        Product::destroy($ids);
        return response()->json(['status' => 'OK', 'ids' => $ids]);
    }

}
