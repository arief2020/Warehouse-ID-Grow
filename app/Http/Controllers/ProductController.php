<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource. (get all products)
     */
    public function index()
    {
        //
        $product = Product::all();
        return response()->json([
            'message' => 'success get all products',
            'data' => $product
        ]);
    }

    /**
     * Store a newly created resource in storage.(create new product)
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'name' => 'required',
            'code' => 'required|unique:products',
            'category' => 'required',
            'location' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $product = Product::create($request->all());

        return response()->json([
            'message' => 'success create new product',
            'data' => $product
        ], 201);
    }

    /**
     * Display the specified resource. (get one product)
     */
    public function show(string $id)
    {
        //
        try {
            $product = Product::findOrFail($id);

        return response()->json([
            'message' => 'success get one product',
            'data' => $product
        ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Not Found',
                'message' => 'Resource not found'
            ], 404);
        }

    }

    /**
     * Update the specified resource in storage. (update product)
     */
    public function update(Request $request, string $id)
    {
        //
        try {

            $validate = $request->validate([
            'name' => 'required',
            'code' => 'required',
            'category' => 'required',
            'location' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);
            $product = Product::findOrFail($id);
            $product->update($request->all());

            return response()->json([
                'message' => 'success update product',
                'data' => $product
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Not Found',
                'message' => 'Resource not found'
            ]);
        }

    }

    /**
     * Remove the specified resource from storage. (delete product)
     */
    public function destroy(string $id)
    {
        //
        try {
            $product = Product::findOrFail($id);
        $product->delete();
        return response()->json([
            'message' => 'success delete product',
            'data' => $product
        ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Not Found',
                'message' => 'Resource not found'
            ], 404);
        }

    }

    public function getMutationsbyProduct(string $id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->mutations;

            return response()->json([
                'message' => 'success get all mutations by product',
                'data' => $product
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Not Found',
                'message' => 'Resource not found'
            ], 404);
        }

    }
}
