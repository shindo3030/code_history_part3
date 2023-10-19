<?php

namespace vendingMachine;

require_once(__DIR__ . '/Item.php');
class CupDrink extends Item
{
  private const PRICES = [
    'hot cup coffee' => 100,
    'ice cup coffee' => 100,
  ];

  static public $depositItems = [
    'hot cup coffee' => 0,
    'ice cup coffee' => 0,
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
    return 1;
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
