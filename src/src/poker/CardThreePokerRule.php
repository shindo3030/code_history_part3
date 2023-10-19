<?php

namespace poker;

require_once('PokerCard.php');
require_once('PokerRule.php');

class CardThreePokerRule implements PokerRule
{
  private const HIGH_CARD = 'high card';
  private const PAIR = 'pair';
  private const STRAIGHT = 'straight';
  private const THREE_CARD = 'three card';

  const ROLE_RANKS = [
    self::HIGH_CARD => 1,
    self::PAIR => 2,
    self::STRAIGHT => 3,
    self::THREE_CARD => 4,
  ];

  public function rankToRoleConvert(array $pokerCards): array
  {
    $ranks = array_map(fn ($pokerCard) => $pokerCard->cardRank(), $pokerCards);
    $name = self::HIGH_CARD;
    $roleRank = 1;
    //３カード用　ランクの強い順に並び替え
    rsort($ranks, SORT_NUMERIC);
    $primary = $ranks[0];
    $secondary = $ranks[1];
    $thrd = $ranks[2];

    if ($this->threeCard($ranks[0], $ranks[1], $ranks[2])) {
      $name = self::THREE_CARD;
    } elseif ($this->pair($ranks)) {
      $name = self::PAIR;
    } elseif ($this->straight($ranks[0], $ranks[1], $ranks[2])) {
      $name = self::STRAIGHT;
      if ($this->isMinMax($ranks[0], $ranks[1], $ranks[2])) {
        $primary = $ranks[1];
        $secondary = $ranks[2];
        $thrd = $ranks[0];
      }
    }
    return [
      'name' => $name,
      'rank' => self::ROLE_RANKS[$name],
      'primary' => $primary,
      'secondary' => $secondary,
      'thrd' => $thrd,
    ];
  }

  private function threeCard(int $cardRank1, int $cardRank2, int $cardRank3): bool
  {
    return $cardRank1 === $cardRank2 && $cardRank1 === $cardRank3 && $cardRank2 === $cardRank3;
  }

  private function pair(array $ranks): bool
  {
    return count(array_unique($ranks)) === 2;
  }

  private function straight(int $cardRank1, int $cardRank2, int $cardRank3): bool
  {
    return $this->isStraight($cardRank1, $cardRank2, $cardRank3) || $this->isMinMax($cardRank1, $cardRank2, $cardRank3);
  }

  private function isStraight(int $cardRank1, int $cardRank2, int $cardRank3): bool
  {
    //通常のストレート条件　見直し　K-A-2
    return abs($cardRank1 - $cardRank2) === 1 && abs($cardRank2 - $cardRank3) === 1;
  }

  private function isMinMax(int $cardRank1, int $cardRank2, int $cardRank3): bool
  {
    //A-2-3が最弱のストレート, （QKAが最強）, 12-0-1 , 10-11,12 , K-A-2はハイカード
    return $cardRank1 === 13 && $cardRank2 === 2 && $cardRank3 === 1;
  }
}
