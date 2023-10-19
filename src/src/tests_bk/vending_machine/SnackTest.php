<?php

namespace vendingMachine\Tests;

use PHPUnit\Framework\TestCase;
use vendingMachine\Snack as Snack;

require_once(__DIR__ . '/../../lib/vending_machine/Snack.php');

class SnackTest extends TestCase
{
  public function testGetPrice()
  {
    $potetoChips = new Snack('poteto chips');
    $this->assertSame(150, $potetoChips->getPrice());
  }

  public function testGetName()
  {
    $potetoChips = new Snack('poteto chips');
    $this->assertSame('poteto chips', $potetoChips->getName());
  }

  public function testUseCup()
  {
    $potetoChips = new Snack('poteto chips');
    $this->assertSame(0, $potetoChips->useCup());
  }

  public function testResidueItem()
  {
    $potetoChips = new Snack('poteto chips');
    //在庫追加後の合計在庫数
    $this->assertSame(0, $potetoChips->residueItem(0));
    $this->assertSame(50, $potetoChips->residueItem(100));
  }
}
