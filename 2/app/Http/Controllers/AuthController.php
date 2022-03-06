<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/login",
     *     description="",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="email",
     *                     description="Email login",
     *                     type="string",
     *                     default="admin@example.com"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     description="Password login",
     *                     type="string",
     *                     default="password"
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="success login",
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="failed login",
     *     ),
     *     tags={
     *         "Auth"
     *     }
     * )
     * */
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($user = Auth::attempt($data)) {
            return response()->json([
                'message' => 'Login successful',
                'token' => Auth::user()->createToken('MyApp')->plainTextToken,
                'type' => 'Bearer',
            ], 200);
        }
        return response()->json(['message' => 'Login failed'], 401);
    }
}
