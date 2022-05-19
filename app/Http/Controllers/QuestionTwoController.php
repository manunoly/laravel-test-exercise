<?php

namespace App\Http\Controllers;

use App\Models\DataInput;
use Exception;
use Illuminate\Http\Request;

class QuestionTwoController extends Controller
{
    public function scenario(Request $request)
    {
        try {
            $filterBy = $request->get('type');
            if (!$filterBy) {
                return response()->json([
                    'message' => 'Missing type parameter'
                ], 400);
            }
            return response()->json([
                'message' => 'Success scenario number two',
                'data' => DataInput::generateDataScenarioTwo($filterBy),
            ]);
        } catch (Exception $error) {
            return response()->json([
                'message' => 'Something went wrong, please try again, report if error persist',
                'details' => $error->getMessage()
            ], 500);
        }
    }
}
