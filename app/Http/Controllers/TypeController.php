<?php

namespace App\Http\Controllers;

use App\Models\DataInput;
use Illuminate\Http\Request;

class TypeController extends Controller
{
       /**
     * @OA\GET(
     * path="/api/types",
     * operationId="Types",
     * tags={"Types"},
     * summary="Return types",
     * description="Return types",
     *      @OA\Response(
     *          response=200,
     *          description="Return types",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )

     */
    public function getTypes()
    {
        return response()->json(
            DataInput::generateDataTypes()
        );
    }
}
