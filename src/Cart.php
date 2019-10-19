<?php

namespace Zen\ShoppingCart;

class Cart implements CartInterface
{
    /**
     * @var string|null
     */
    private $instance;

    public function __construct(string $instance = 'default')
    {
        $this->instance = $instance;
    }


    /**
     * Permet de retourner les items du panier
     * @return CartItems
     */
    public function getItems(): CartItems
    {
        if (isset($_SESSION['cart'][$this->instance])) {
            return new CartItems($_SESSION['cart'][$this->instance]);
        }
        return new CartItems([]);
    }

    /**
     * Permet d'ajouter un item au panier
     * @param int $itemId
     * @param $item
     * @param int $qty
     * @return bool
     */
    public function addItem(int $itemId, array $item, int $qty = 1): bool
    {
        if ($this->create()) {
            if (isset($_SESSION['cart'][$this->instance][$itemId])) {
                $this->updateItem($itemId, $qty);
            }
            $_SESSION['cart'][$this->instance][$itemId] = new ItemWithQuantity($item, $qty);
            return true;
        }
        return false;
    }

    public function updateItem(int $itemId, int $qty = 1): bool
    {
        if ($this->create()) {
            if (isset($_SESSION['cart'][$this->instance][$itemId])) {
                $itemWithQuantity = $_SESSION['cart'][$this->instance][$itemId];
                $qty = $itemWithQuantity->getQuantity() + $qty;
                $_SESSION['cart'][$this->instance][$itemId] = new ItemWithQuantity(
                    $itemWithQuantity->getItem(),
                    $qty
                );
                return true;
            }
        }
        return false;
    }

    /**
     * Permet d'enlever un item du panier
     * @param $itemId
     * @return bool
     */
    public function removeItem(int $itemId): bool
    {
        if (isset($_SESSION['cart'][$this->instance][$itemId])) {
            unset($_SESSION['cart'][$this->instance][$itemId]);
            return true;
        }
        return false;
    }


    /**
     * Permet supprimer le panier
     * @return bool
     */
    public function flush()
    {
        if (isset($_SESSION['cart'][$this->instance])) {
            unset($_SESSION['cart'][$this->instance]);
            return true;
        }
        return false;
    }

    /**
     * Permet de créer un painer
     * @return bool
     */
    private function create()
    {
        if (!isset($_SESSION['cart'][$this->instance])) {
            $_SESSION['cart'][$this->instance] = [];
        }
        return true;
    }
}
