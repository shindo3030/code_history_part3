<?php

namespace vendingMachine;

abstract class Item
{

  public function __construct(protected string $name)
  {
  }

  abstract public function getPrice(): int;
  abstract public function useCup(): int;
  abstract public function residueItem(int $addItem): int;
  public function getName(): string
  {
    return $this->name;
  }
}





// abstract class Item
// {
//   public function __construct(protected string $name)
//   {
//   }

//   abstract public function getPrice();
//   abstract public function useCup();

//   public function getName(): string
//   {
//     return $this->name;
//   }
// }
