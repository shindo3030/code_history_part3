<?php

namespace vendingMachine;

// require_once(__DIR__ . '/Item.php');
require_once('Item.php');
class VendingMachine
{
  public int $depositCoin = 0;
  public int $cupNum = 0;
  public int $itemNum = 0;


  public function depositCoin(int $coin): int
  {
    //入れたお金は100円のみ有効
    if ($coin === 100) {
      return $this->depositCoin += $coin;
      //100円以外を入れた場合は無効
    } else {
      return $this->depositCoin;
    }
  }

  public function pressButton(Item $item): string
  {
    $price = $item->getPrice();
    $useCup = $item->useCup();
    //残アイテム数を取得
    $itemNum = $this->itemNum;

    //100円以上デポジットした場合
    if ($this->depositCoin >= $price && $this->cupNum >= $useCup && $itemNum > 0) {
      $this->cupNum -= $useCup;
      $this->depositCoin -= $price;
      //残アイテム数から-1をして元の配列へ戻す
      $this->itemNum -= 1;
      return $item->getName();
    } else {
      return '';
    }
  }

  public function addCup(int $cups): int
  {
    $cupNum = $this->cupNum + $cups;
    if ($cupNum > 100) {
      $cupNum = 100;
    }
    $this->cupNum = $cupNum;
    return $this->cupNum;
  }

  public function depositItem(Item $item, int $addItemNum): int
  {
    $this->itemNum = $item->residueItem($addItemNum);
    return $this->itemNum;
  }

  public function receiveChange(): int
  {
    return $this->depositCoin;
  }
}
