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
     * @param string|null $cartInstance
     * @return CartItems|array
     */
    public function getItems(?string $cartInstance = null)
    {
        if (!is_null($cartInstance)) {
            if (isset($_SESSION['cart'][$cartInstance])) {
                return new CartItems($_SESSION['cart'][$cartInstance]);
            }
        } else {
            if (isset($_SESSION['cart'][$this->instance])) {
                return new CartItems($_SESSION['cart'][$this->instance]);
            }
        }
        return [];
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
                $itemWithQuantity = $_SESSION['cart'][$this->instance][$itemId];
                $qty = $itemWithQuantity->getQuantity() + $qty;
                $_SESSION['cart'][$this->instance][$itemId] = new ItemWithQuantity($item, $qty);
                return true;
            }
            $_SESSION['cart'][$this->instance][$itemId] = new ItemWithQuantity($item, $qty);
            return true;
        }
        return false;
    }

    public function updateItem(int $itemId, int $qty = 1): bool
    {
        // TODO: Implement updateItem() method.
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
        if (isset($_SESSION['cart'])) {
            unset($_SESSION['cart']);
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
