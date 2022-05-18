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
    public function getSortedItems()
    {
        $sorted = array();
        foreach ($this->items as $item) {
            //FIXME: this will overwrite items with the same price, use multidimentional array to avoid and then merge
            $sorted[($item->getTotalPrice() * 100)][] = $item;
        }
        ksort($sorted, SORT_NUMERIC);
        return call_user_func_array('array_merge', array_values($sorted));
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

    /**
     * Return items
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Return items
     */
    public function getTotalPrice()
    {
        return array_reduce($this->items, function ($total, $item) {
            $total += $item->getTotalPrice();
            return $total;
        });
    }
}
