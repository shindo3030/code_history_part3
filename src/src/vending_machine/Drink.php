<?php

namespace vendingMachine;

require_once(__DIR__ . '/Item.php');
class Drink extends Item
{
  private const PRICES = [
    'cider' => 100,
    'cola' => 150,
  ];

  static public $depositItems = [
    'cider' => 0,
    'cola' => 0,
  ];

  public function __construct($name)
  {
    parent::__construct($name);
  }

  public function getPrice(): int
  {
    return self::PRICES[$this->name];
  }

  public function useCup(): int
  {
    return 0;
  }

  public function residueItem(int $addItem): int
  {
    $itemNum = self::$depositItems[$this->name] + $addItem;
    if ($itemNum >= 50) {
      self::$depositItems[$this->name] = 50;
      $itemNum = 50;
    }
    return $itemNum;
  }
}





// require_once(__DIR__ . '/Item.php');

// class Drink extends Item
// {
//   private const PRICES = [
//     'cider' => 100,
//     'cola' => 150,
//   ];

//   public function __construct(string $name)
//   {
//     //parentは親クラスのメソッドを呼び出すもの
//     parent::__construct($name);
//   }

//   public function getPrice(): int
//   {
//     return self::PRICES[$this->name];
//   }


//   //消費するカップ
//   public function useCup(): int
//   {
//     return 0;
//   }
// }
