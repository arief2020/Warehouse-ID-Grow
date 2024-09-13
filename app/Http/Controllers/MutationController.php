<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mutation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MutationController extends Controller
{
    /**
     * Display a listing of the resource. (get all products)
     */
    public function index(Request $request)
    {
        $type = $request->query('type');
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');


        if (!$endDate) {
            $endDate = now()->toDateString();
        }

        $query = Mutation::query();

        if ($type) {
            $query->where('type', $type);
        }

        if ($startDate) {
            $query->whereBetween('date', [$startDate, $endDate]);
        } else {
            $query->where('date', '<=', $endDate);
        }


        $mutations = $query->get();

        return response()->json([
            'message' => 'success get filtered mutations',
            'data' => $mutations
        ]);
    }

    /**
     * Store a newly created resource in storage.(create new product)
     */
    public function store(Request $request)
    {
        //
        $user = Auth::user();

        $userId = $user->id;

        $request->validate([
            'type' => 'required',
            'date' => 'required',
            'amount' => 'required',
            'product_id' => 'required',
        ]);

        $data = $request->all();
        $data['user_id'] = $userId;

        $mutation = Mutation::create($data);

        return response()->json([
            'message' => 'mutation created successfully',
            'data' => $mutation
        ]);
    }

    /**
     * Display the specified resource. (get one product)
     */
    public function show(string $id)
    {
        //
        try {
            $mutation = Mutation::findOrFail($id);
            return response()->json([
                'message' => 'success get one mutation',
                'data' => $mutation
            ]);
        } catch (ModelNotFoundException $th) {
            return response()->json([
                'error' => 'Not Found',
                'message' => 'mutation not found',
            ], 404);
        }

    }

    /**
     * Update the specified resource in storage. (update product)
     */
    public function update(Request $request, string $id)
    {

        try {
            $user = Auth::user();

            $userId = $user->id;


            $request->validate([
                'type' => 'required',
                'date' => 'required',
                'amount' => 'required',
                'product_id' => 'required',
            ]);

            $data = $request->all();
            $data['user_id'] = $userId;

            $mutation = Mutation::findOrFail($id);
            $mutation->update($data);

            return response()->json([
                'message' => 'mutation updated successfully',
                'data' => $mutation
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
            $mutation = Mutation::findOrFail($id);
            $mutation->delete();
            return response()->json([
                'message' => 'mutation deleted successfully',
                'data' => $mutation
            ]);
        } catch (ModelNotFoundException $th) {
            return response()->json([
                'error' => 'Not Found',
                'message' => 'Resource not found'
            ], 404);
        }

    }
}
