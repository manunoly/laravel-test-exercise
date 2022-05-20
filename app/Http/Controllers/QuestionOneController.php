<?php

namespace App\Http\Controllers;

use App\Models\DataInput;
use Exception;
use Illuminate\Http\Request;

class QuestionOneController extends Controller
{
    /**
     * @OA\GET(
     * path="/api/question/one",
     * operationId="Scenario",
     * tags={"Question"},
     * summary="Question one",
     * security={{"bearer_token":{}}},
     * description="Question one here",
     *      @OA\Response(
     *          response=200,
     *          description="Success Scenario one",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )

     */
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
