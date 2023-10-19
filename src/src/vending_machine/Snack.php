<?php

namespace vendingMachine;

require_once(__DIR__ . '/Item.php');
class Snack extends Item
{
  private const PRICES = [
    'poteto chips' => 150,
  ];

  static public $depositItems = [
    'poteto chips' => 0,
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
