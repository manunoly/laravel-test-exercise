<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
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
