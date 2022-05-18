<?php

namespace App\Models;

use ErrorException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class ElectronicItem extends Model
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
    private $extrasList;
    /**
     * @var int
     */
    private $maxExtras;
    public $wired;

    const ELECTRONIC_ITEM_TELEVISION = 'television';
    const ELECTRONIC_ITEM_CONSOLE = 'console';
    const ELECTRONIC_ITEM_MICROWAVE = 'microwave';
    const ELECTRONIC_ITEM_CONTROLLER = 'controller';
    public static $types = array(
        self::ELECTRONIC_ITEM_CONSOLE,
        self::ELECTRONIC_ITEM_MICROWAVE,
        self::ELECTRONIC_ITEM_TELEVISION,
        self::ELECTRONIC_ITEM_CONTROLLER
    );

    function __construct($maxExtras, $arg = [], $extras = null)
    {
        foreach ($arg as $key => $value) {
            switch ($key) {
                case 'price':
                    $this->price = $value;
                    break;
                case 'type':
                    $this->type = $value;
                    break;
                case 'wired':
                    $this->wired = $value;
                    break;
                default:
                    break;
            }
        }
        $this->maxExtras = $maxExtras;
        if ($maxExtras && $extras) {
            if ('array' != gettype($extras)) {
                throw new ErrorException('Not valid items input, items must be an array');
            }
            if (count($extras) > $maxExtras) {
                throw new ErrorException('To many items as input');
            }
            $this->extrasList = new ElectronicItems($extras);
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

    function getTotalPrice()
    {
        $price = $this->getPrice();
        if (isset($this->extrasList)) {
            foreach ($this->extrasList->getItems() as $item) {
                $price += $item->getPrice();
            }
        }
        return $price;
    }

    /**
     * Return data as json
     * overwrite method to return object data
     */
    public function jsonSerialize()
    {
        $data = [
            'price' => $this->getPrice(),
            'type' => $this->getType(),
            'wired' => $this->getWired(),
            'totalPrice' => $this->getTotalPrice(),
            'extras' => $this->extrasList ? $this->extrasList->getItems() : ''
        ];

        return $data;
    }
}
