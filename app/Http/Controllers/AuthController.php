<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        try {
            // Validate the request data
            $registerUserData = $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|email|unique:users',
                'password' => 'required|min:8'
            ]);

            // Create the user
            $user = User::create([
                'name' => $registerUserData['name'],
                'email' => $registerUserData['email'],
                'password' => Hash::make($registerUserData['password']),
            ]);

            // Return success response
            return response()->json([
                'message' => 'User Created Successfully',
                'user' => $user,
            ], 201);

        } catch (ValidationException $e) {
            // Handle validation errors
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors(),
            ], 422);

        } catch (QueryException $e) {
            // Handle database errors, such as duplicate entries
            return response()->json([
                'message' => 'Database Error',
                'errors' => $e->getMessage(),
            ], 500);

        } catch (\Exception $e) {
            // Handle any other exceptions
            return response()->json([
                'message' => 'An error occurred',
                // 'errors' => $e->getMessage(),
                'errors' => "Internal Server Error",
            ], 500);
        }
    }
    //

    public function login(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($validatedData)) {
            $user = Auth::user();
            $token = $user->createToken('API Token')->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
                'user' => $user,
            ], 200);
        }

        // Return an error response if authentication fails
        return response()->json([
            'error' => 'Unauthorized',
            'message' => 'The provided credentials are incorrect.'
        ], 401);
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logout successful'
        ], 200);
        } catch (\Exception $th) {
           return response()->json([
            'message' => $request->user()
        ], 400);
        }

    }
}
