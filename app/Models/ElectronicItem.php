<?php

namespace App\Models;

use ErrorException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectronicItem extends Model
{
    use HasFactory;
    /**
     * @var float
     */
    public $price;
    /**
     * @var string
     */
    private $type;
    /**
     * @var ElectronicItems
     */
    private $itemList;
    /**
     * @var int
     */
    private $maxExtras;
    public $wired;

    const ELECTRONIC_ITEM_TELEVISION = 'television';
    const ELECTRONIC_ITEM_CONSOLE = 'console';
    const ELECTRONIC_ITEM_MICROWAVE = 'microwave';
    public static $types = array(
        self::ELECTRONIC_ITEM_CONSOLE,
        self::ELECTRONIC_ITEM_MICROWAVE, self::ELECTRONIC_ITEM_TELEVISION
    );

    function __construct($maxExtras, $items = null)
    {
        $this->maxExtras = $maxExtras;
        if ($maxExtras && $items) {
            if ('array' != gettype($items)) {
                throw new ErrorException('Not valid items input, items must be array');
            }
            if (count($items) > $maxExtras) {
                throw new ErrorException('To many items as input');
            }
            $this->itemList =  new ElectronicItems($items);
        }
    }

    function getPrice()
    {
        return $this->price;
    }

    function getType()
    {
        return $this->type;
    }

    function getWired()
    {
        return $this->wired;
    }

    function setPrice($price)
    {
        $this->price = $price;
    }

    function setType($type)
    {
        $this->type = $type;
    }

    function setWired($wired)
    {
        $this->wired = $wired;
    }

    function getMaxExtras()
    {
        return $this->maxExtras;
    }
}
