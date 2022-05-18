<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Television extends ElectronicItem
{
    use HasFactory;
    const MAX_EXTRAS = PHP_INT_MAX;

    function __construct($arg = [], $extras = null)
    {
        parent::__construct(Self::MAX_EXTRAS, $arg, $extras);
    }
}
