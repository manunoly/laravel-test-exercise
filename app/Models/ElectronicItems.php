<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ElectronicItem;

class ElectronicItems extends Model
{
    use HasFactory;
    private $items = array();
    public function __construct(array $items)
    {
        $this->items = $items;
    }
    /**
     * Returns the items depending on the sorting type requested
     *
     * @return array
     */
    public function getSortedItems($type)
    {
        $sorted = array();
        foreach ($this->items as $item) {
            //FIXME: this will overwrite items with the same price
            $sorted[($item->price * 100)] = $item;
        }
        return ksort($sorted, SORT_NUMERIC);
    }
    /**
     *
     * @param string $type
     * @return array
     */
    public function getItemsByType($type)
    {
        if (in_array($type, ElectronicItem::$types)) {
            $callback = function ($item) use ($type) {
                return $item->type == $type;
            };
            $items = array_filter($this->items, $callback);
        }
        return false;
    }
}