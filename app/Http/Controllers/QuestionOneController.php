<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionOneController extends Controller
{
    public function scenario(Request $request)
    {
        return response()->json([
            'message' => 'Success scenario number one',
            'data' => '',
        ]);
    }
}
