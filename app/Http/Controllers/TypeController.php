<?php

namespace App\Http\Controllers;

use App\Models\DataInput;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function getTypes()
    {
        return response()->json(
            DataInput::generateDataTypes()
        );
    }
}
