<?php


use PHPUnit\Framework\TestCase;
use Zen\ShoppingCart\Cart;

class CartTest extends TestCase
{

    /**
     * @var Cart
     */
    private $cart;

    protected function setUp(): void
    {
        $this->cart = new Cart();
    }

    public function testAddItem()
    {
        $this->assertTrue($this->cart->addItem(
            1,
            [
                'name' => 'product1',
                'price' => 2000
            ],
            1
        ));
        $this->cart->flush();
    }

    public function testCartItemsTotalPrice()
    {
        $this->cart->addItem(1, ['name' => 'product1', 'price' => 2000], 1);
        $this->cart->addItem(2, ['name' => 'product1', 'price' => 2000], 2);
        $this->assertEquals(6000, $this->cart->getItems()->totalPrice());
        $this->cart->flush();
    }

    public function testCartRemoveItem()
    {
        $this->cart->addItem(2, ['name' => 'product1', 'price' => 2000], 2);
        $this->assertTrue($this->cart->removeItem(2));
    }

    public function testCartUpdateItem()
    {
        $this->cart->addItem(2, ['name' => 'product1', 'price' => 2000], 2);
        $this->cart->addItem(1, ['name' => 'product2', 'price' => 2000], 2);
        $this->assertTrue($this->cart->updateItem(2, 3));
        $this->assertEquals(5, $this->cart->getItems()[2]['qty']);
        $this->assertEquals(2, $this->cart->getItems()[1]['qty']);
    }


}
