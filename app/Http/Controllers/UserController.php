<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;


class UserController extends Controller
{


    public function index()
    {
            $users = User::all();

            return response()->json([
                'message' => 'Users retrieved successfully',
                'data' => $users
            ], 200);
        }


    public function show(string $id)
    {
        try {
            $user = User::findOrFail($id);

            return response()->json([
                'message' => 'Successfully retrieved user',
                'data' => $user
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Not Found',
                'message' => 'Resource not found'
            ], 404);
        } catch (Throwable $e) {
            return response()->json([
                'error' => 'Internal Server Error',
                'message' => $e->getMessage()
            ], 500);
        }

    }


    /**
     * Update the specified resource in storage. (update product)
     */
    public function update(Request $request, string $id)
    {
        //
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
            ]);

            $user = User::findOrFail($id);
            $user->update($validatedData);

            return response()->json([
                'message' => 'Successfully updated user',
                'data' => $user
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Not Found',
                'message' => 'Resource not found'
            ], 404);
        }

    }

    /**
     * Remove the specified resource from storage. (delete product)
     */
    public function destroy(string $id)
    {
            try {
            $user = User::findOrFail($id);

            $user->delete();

            return response()->json([
                'message' => 'Successfully deleted user',
                'data' => $user
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Not Found',
                'message' => 'Resource not found'
            ], 404);

    }
}

    public function getMutationsbyUser(string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->mutations;

            return response()->json([
                'data' => $user
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Not Found',
                'message' => 'User not found'
            ], 404);
        }

    }


}
