<?php

namespace App\Http\Controllers;

use App\Models\DataInput;
use Illuminate\Http\Request;

class QuestionOneController extends Controller
{
    public function scenario(Request $request)
    {
        return response()->json([
            'message' => 'Success scenario number one',
            'data' => DataInput::generateDataScenarioOne(),
        ]);
    }
}
