<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();

        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request) {
        $this->auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
}
// $this->renderable(function (InvalidOrderException $e, $request) {
//     return response()->json([
//         'status code' => 500,
//         'message' => 'Server Error'
//     ], 500);
// });

// $this->renderable(function (ValidationException $e, $request) {
//     return response()->json([
//         'status code' => 422,
//         'message' => 'Du lieu khong hop le'
//     ], 422);
// });

// protected function failResponse(string $message, int $status = 400)
// {
//     return response()->json([
//         'status' => $status,
//         'message' => $message
//     ], $status);
// }

// $product = Product::paginate(2);
// return ProductResource::collection($product);

// return [
//     'data' => $this->collection,
// ];
