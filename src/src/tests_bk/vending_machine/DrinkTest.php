<?php

namespace vendingMachine\Tests;

use PHPUnit\Framework\TestCase;
use vendingMachine\Drink as Drink;


require_once(__DIR__ . '/../../lib/vending_machine/Drink.php');

class DrinkTest extends TestCase
{
  public function testGetPrice()
  {
    $cola = new Drink('cola');
    $this->assertSame(150, $cola->getPrice());
  }

  public function testGetName()
  {
    $cola = new Drink('cola');
    $this->assertSame('cola', $cola->getName());
  }

  public function testUseCup()
  {
    $cola = new Drink('cola');
    $this->assertSame(0, $cola->useCup());
  }

  public function testResidueItem()
  {
    $cola = new Drink('cola');
    //在庫追加後の合計在庫数
    $this->assertSame(0, $cola->residueItem(0));
    $this->assertSame(50, $cola->residueItem(100));
  }
}
