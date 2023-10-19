<?php

namespace vendingMachine\Tests;

//ボタンを押すとサイダーが出る！
use PHPUnit\Framework\TestCase;
use vendingMachine\VendingMachine as VendingMachine;
use vendingMachine\CupDrink as CupDrink;
use vendingMachine\Drink as Drink;
use vendingMachine\Snack as Snack;



require_once(__DIR__ . '/../../lib/vending_machine/VendingMachine.php');
require_once(__DIR__ . '/../../lib/vending_machine/Item.php');
require_once(__DIR__ . '/../../lib/vending_machine/Drink.php');
require_once(__DIR__ . '/../../lib/vending_machine/CupDrink.php');
require_once(__DIR__ . '/../../lib/vending_machine/Snack.php');

class VendingMachineTest extends TestCase
{

  public function testDepositCoin()
  {
    $VendingMachine = new VendingMachine();
    $this->assertSame(0, $VendingMachine->depositCoin(0));
    $this->assertSame(0, $VendingMachine->depositCoin(150));
    $this->assertSame(100, $VendingMachine->depositCoin(100));
  }

  public function testPressButton()
  {
    //$vendingMachine には　クラスVendingMachineインスタンス生成時に引数を何も渡していないため　プロパティにはクラス名だけが入る

    $cider = new Drink('cider');
    $cola = new Drink('cola');
    $hotCupCoffee = new CupDrink('hot cup coffee');
    $potetoChips = new Snack('poteto chips');
    $vendingMachine =  new VendingMachine();

    # お金が投入されていない場合は購入できない
    $this->assertSame('', $vendingMachine->pressButton($cider));

    # 100円を入れた場合はサイダーを購入できるが
    $vendingMachine->depositCoin(100);
    //在庫がないと購入できない
    $this->assertSame('', $vendingMachine->pressButton($cider));
    //在庫があると購入できる(サイダー在庫+1)
    $vendingMachine->depositItem($cider, 1);
    $this->assertSame('cider', $vendingMachine->pressButton($cider));

    //投入金額が１００円の場合は購入できないコーラ
    $vendingMachine->depositCoin(100);
    $vendingMachine->depositItem($cola, 1);
    $this->assertSame('', $vendingMachine->pressButton($cola));
    //投入金額が200円だと購入できるコーラ
    $vendingMachine->depositCoin(100);
    $this->assertSame('cola', $vendingMachine->pressButton($cola));

    //カップが投入されていない場合は購入できない
    $vendingMachine->depositCoin(100);
    $vendingMachine->depositItem($hotCupCoffee, 1);
    $this->assertSame('', $vendingMachine->pressButton($hotCupCoffee));

    //カップを入れた場合は購入できる
    $vendingMachine->addCup(1);
    $this->assertSame('hot cup coffee', $vendingMachine->pressButton($hotCupCoffee));


    //スナックの購入、合計150円以上投入していない場合は購入できない
    $vendingMachine->depositItem($potetoChips, 1);
    $this->assertSame('', $vendingMachine->pressButton($potetoChips));
    //150円投入後、ポテトチップス購入できる
    $vendingMachine->depositCoin(100);
    $vendingMachine->depositCoin(100);
    $this->assertSame('poteto chips', $vendingMachine->pressButton($potetoChips));
  }

  public function testAddCup()
  {
    $vendingMachine = new vendingMachine();
    $this->assertSame(99, $vendingMachine->addCup(99));
    $this->assertSame(100, $vendingMachine->addCup(1));
    $this->assertSame(100, $vendingMachine->addCup(1));
  }

  public function testDepositItem()
  {
    $vendingMachine = new VendingMachine();
    $cider = new Drink('cider');
    $hotCupCoffee = new CupDrink('hot cup coffee');
    #　サイダーの在庫の上限が５０個の場合
    $this->assertSame(50, $vendingMachine->depositItem($cider, 50));
    $this->assertSame(50, $vendingMachine->depositItem($cider, 1));
    $this->assertSame(50, $vendingMachine->depositItem($cider, 100));
    $this->assertSame(50, $vendingMachine->depositItem($hotCupCoffee, 100));
  }

  public function testReceiveChange()
  {
    $vendingMachine = new VendingMachine();
    $this->assertSame(0, $vendingMachine->receiveChange());
    $vendingMachine->depositCoin(100);
    $this->assertSame(100, $vendingMachine->receiveChange());
  }
}
