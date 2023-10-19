<?php

namespace poker;

class PokerCard
{
  public const CARD_RANKS = [
    '2' => 1,
    '3' => 2,
    '4' => 3,
    '5' => 4,
    '6' => 5,
    '7' => 6,
    '8' => 7,
    '9' => 8,
    '10' => 9,
    'J' => 10,
    'Q' => 11,
    'K' => 12,
    'A' => 13,
  ];
  //カード枚数が増えても対応できるように１枚ずつ順に渡して、判定している
  public function __construct(private string $playerCard)
  {
  }

  public function cardRank(): int
  {
    return self::CARD_RANKS[substr($this->playerCard, 1, strlen($this->playerCard) - 1)];
  }
}













#カードをランクに変換する処理(カードに対して何かを行う場所)
// class PokerCard
// {
//   const CRAD_RANKS = [
//     '2' => 1,
//     '3' => 2,
//     '4' => 3,
//     '5' => 4,
//     '6' => 5,
//     '7' => 6,
//     '8' => 7,
//     '9' => 8,
//     '10' => 9,
//     'J' => 10,
//     'Q' => 11,
//     'K' => 12,
//     'A' => 13,
//   ];

//   public function __construct(private string $suitNum)
//   {
//   }

//   public function cardRank(): int
//   {
//     return self::CRAD_RANKS[substr($this->suitNum, 1, strlen($this->suitNum) - 1)];
//   }
// }
