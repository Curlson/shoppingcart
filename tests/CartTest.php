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
    }
}
