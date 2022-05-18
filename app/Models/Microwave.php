<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Microwave extends ElectronicItem
{
    use HasFactory;

    const MAX_EXTRAS = 0;

    function __construct($arg = [])
    {
        parent::__construct(Self::MAX_EXTRAS, $arg);
    }
}
