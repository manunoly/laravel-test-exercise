<?php

namespace App\Http\Controllers;

use App\Models\DataInput;
use Exception;
use Illuminate\Http\Request;

class QuestionOneController extends Controller
{
    public function scenario(Request $request)
    {
        try {
            return response()->json([
                'message' => 'Success scenario number one',
                'data' => DataInput::generateDataScenarioOne(),
            ]);
        } catch (Exception $error) {
            return response()->json([
                'message' => 'Something went wrong, please try again, report if error persist',
                'details' => $error->getMessage()
            ]);
        }
    }
}
