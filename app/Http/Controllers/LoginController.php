<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * @OA\Post(
     * path="/api/login",
     * operationId="authLogin",
     * tags={"Login"},
     * summary="User Login",
     * description="Login User Here, default user: <b>welove@code.com</b>,  password: <b>welovecode</b> ",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"email", "password"},
     *               @OA\Property(property="email", type="email"),
     *               @OA\Property(property="password", type="password")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=201,
     *          description="Login Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Login Successfully",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function login(Request $request)
    {
        try {
            if (!$request->get('email') || !$request->get('password')) {
                return response()->json([
                    'message' => 'Missing parameters'
                ], 400);
            }
            if ($request->get('email') == env('DUMMY_USER', '') && Hash::check($request->get('password'), env('DUMMY_PASS', ''))) {
                return response()->json([
                    'message' => 'Success login',
                    'token' => env('DUMMY_TOKEN', ''),
                ]);
            }
            return response()->json([
                'message' => 'Please check your user and password'
            ], 403);
        } catch (Exception $error) {
            return response()->json([
                'message' => 'Something went wrong, please try again, report if error persist',
                'details' => $error->getMessage()
            ]);
        }
    }
}
