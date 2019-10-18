<?php


namespace Zen\ShoppingCart;

class ItemWithQuantity
{
    private $item;
    /**
     * @var int
     */
    private $quantity;

    /**
     * ProductWithQuantity constructor.
     * @param $item
     * @param int $quantity
     */
    public function __construct(array $item, int $quantity = 1)
    {
        $this->item = $item;
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }
}
