<?php


namespace Zen\ShoppingCart;

interface CartInterface
{
    public function addItem(int $itemId, array $item, int $qty = 1): bool;
    
    public function updateItem(int $itemId, int $qty = 1): bool;
    
    public function removeItem(int $itemId): bool;
}
