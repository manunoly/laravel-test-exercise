<?php

namespace App\Http\Controllers;

use App\Models\DataInput;
use Exception;
use Illuminate\Http\Request;

class QuestionTwoController extends Controller
{
       /**
     * @OA\GET(
     * path="/api/question/two?type=console",
     * operationId="ScenarioTwo",
     * tags={"Question"},
     * summary="Question two",
     * security={{"bearer_token":{}}},
     * description="Question two here",
     *      @OA\Response(
     *          response=200,
     *          description="Success Scenario two",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )

     */
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
