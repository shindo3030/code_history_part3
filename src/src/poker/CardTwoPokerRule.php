<?php

namespace poker;

require_once('PokerCard.php');
require_once('PokerRule.php');
class CardTwoPokerRule implements PokerRule
{
  private const HIGH_CARD = 'high card';
  private const PAIR = 'pair';
  private const STRAIGHT = 'straight';

  private const ROLE_RANKS = [
    self::HIGH_CARD => 1,
    self::PAIR => 2,
    self::STRAIGHT => 3,
  ];

  //$pokerCards　は　PokerCardのインスタンスプロパティを受け取った引数なのでテストの際は注意！
  public function rankToRoleConvert(array $pokerCards): array
  {

    $ranks = array_map(fn ($pokerCard) => $pokerCard->cardRank(), $pokerCards);
    $name = self::HIGH_CARD;
    $roleRank = 1;
    $primary = max($ranks);
    $secondary = min($ranks);


    if ($this->isPair($ranks[0], $ranks[1])) {
      $name = self::PAIR;
      $roleRank = self::ROLE_RANKS[self::PAIR];
    } elseif ($this->isStraight($ranks[0], $ranks[1]) || $this->isStraightLow($ranks[0], $ranks[1])) {
      $name = self::STRAIGHT;
      $roleRank = self::ROLE_RANKS[self::STRAIGHT];
      if ($this->isStraightLow($ranks[0], $ranks[1])) {
        $primary = $secondary;
        $secondary = $primary;
      }
    }
    return [
      'name' => $name,
      'rank' => self::ROLE_RANKS[$name],
      'primary' => $primary,
      'secondary' => $secondary,
    ];
  }

  private function isStraight(int $cardRank1, int $cardRank2): bool
  {
    return abs($cardRank1 - $cardRank2) === 1;
  }

  private function isPair(int $cardRank1, int $cardRank2): bool
  {
    return $cardRank1 === $cardRank2;
  }

  private function isStraightLow(int $cardRank1, int $cardRank2): bool
  {
    return abs($cardRank1 - $cardRank2) === 12;
  }
}
