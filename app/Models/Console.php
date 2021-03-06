<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use phpDocumentor\Reflection\Types\Self_;

class Console extends ElectronicItem
{
    use HasFactory;

    const MAX_EXTRAS = 4;

    function __construct($arg = [], $extras = null)
    {
        parent::__construct(Self::MAX_EXTRAS, $arg, $extras);
    }
}
