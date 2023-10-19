<?php

namespace vendingMachine\Tests;

use PHPUnit\Framework\TestCase;
use vendingMachine\CupDrink as CupDrink;


require_once(__DIR__ . '/../../lib/vending_machine/CupDrink.php');

class CupDrinkTest extends TestCase
{
  public function testGetPrice()
  {
    $hotCupCoffee = new CupDrink('hot cup coffee');
    $this->assertSame(100, $hotCupCoffee->getPrice());
  }

  public function testGetName()
  {
    $hotCupCoffee = new CupDrink('hot cup coffee');
    $this->assertSame('hot cup coffee', $hotCupCoffee->getName());
  }

  public function testUseCup()
  {
    $hotCupCoffee = new CupDrink('hot cup coffee');
    $this->assertSame(1, $hotCupCoffee->useCup());
  }

  public function testResidueItem()
  {
    $hotCupCoffee = new CupDrink('hot cup coffee');
    $hotCupCoffee = new CupDrink('hot cup coffee');
    //在庫追加後の合計在庫数
    $this->assertSame(0, $hotCupCoffee->residueItem(0));
    $this->assertSame(50, $hotCupCoffee->residueItem(100));
  }
}
