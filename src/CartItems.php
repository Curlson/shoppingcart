<?php


namespace Zen\ShoppingCart;

use Traversable;

class CartItems implements \IteratorAggregate
{

    /**
     * @var array
     */
    private $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }


    public function totalPrice()
    {
        $totalPrice = null;
        foreach ($this->items as $itemWithQuantity) {
            $price  = $itemWithQuantity->getItem()['price'] * $itemWithQuantity->getQuantity();
            $totalPrice += $price;
        }
        if ($totalPrice) {
            return $totalPrice;
        }
        return 0;
    }

    /**
     * Retrieve an external iterator
     * @link https://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     * @since 5.0.0
     */
    public function getIterator()
    {
        $items = [];
        foreach ($this->items as $itemWithQuantity) {
            $items[] = array_merge($itemWithQuantity->getItem(), [
                'qty' => $itemWithQuantity->getQuantity()
            ]);
        }
        return new \ArrayIterator($items);
    }
}
