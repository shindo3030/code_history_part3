<?php

namespace poker;

require_once('PokerCard.php');
require_once('PokerRule.php');

class CardFivePokerRule implements PokerRule
{
  private const HIGH_CARD = 'high card';
  private const ONE_PAIR = 'one pair';
  private const TWO_PAIR = 'two pair';
  private const THREE_CARD = 'three of a kind';
  private const STRAIGHT = 'straight';
  private const FULL_HOUSE = 'full house';
  private const FOUR_OF_A_KIND = 'four of a kind';

  public function rankToRoleConvert(array $pokerCards): string
  {
    $ranks = array_map(fn ($pokerCard) => $pokerCard->cardRank(), $pokerCards);
    sort($ranks);
    //３カード用　ランクの強い順に並び替え
    // rsort($ranks, SORT_NUMERIC);

    $name = self::HIGH_CARD;
    if ($this->fourCard($ranks)) {
      $name = self::FOUR_OF_A_KIND;
    } elseif ($this->fullHouse($ranks)) {
      $name = self::FULL_HOUSE;
    } elseif ($this->straight($ranks)) {
      $name = self::STRAIGHT;
    } elseif ($this->threeCard($ranks)) {
      $name = self::THREE_CARD;
    } elseif ($this->twoPair($ranks)) {
      $name = self::TWO_PAIR;
    } elseif ($this->onePair($ranks)) {
      $name = self::ONE_PAIR;
    }
    return $name;
  }

  private function threeCard(array $ranks): bool
  {
    //3枚のカードが同じ数字   3 3 3 5 6     5 6 8 8 8    1 3 3 3 6　　３パターん
    return count(array_unique(array_slice($ranks, 0, 3))) === 1 ||
      count(array_unique(array_slice($ranks, 1, 3))) === 1 || count(array_unique(array_slice($ranks, 2, 3))) === 1;
  }

  private function onePair(array $ranks): bool
  {
    //２枚のカードが同じ数字  2 2 4 6 8   1 2 2 4 5   ４パターン
    return count(array_unique($ranks)) === 4;
  }

  private function twoPair(array $ranks): bool
  {
    //２枚のカードが同じ数字、それが二つ  2 2 4 5 5   2 2 3 3 6   1 2 2 3 3  ３パターン
    return (count(array_unique(array_slice($ranks, 0, 2))) === 1 && count(array_unique(array_slice($ranks, 2, 2))) === 1) || (count(array_unique(array_slice($ranks, 0, 2))) === 1 && count(array_unique(array_slice($ranks, 3, 2))) === 1) || (count(array_unique(array_slice($ranks, 1, 2))) === 1 && count(array_unique(array_slice($ranks, 3, 2))) === 1);
  }

  private function fourCard(array $ranks): bool
  {
    //４枚のカードが同じ数字    1 1 1 1 2     1 2 2 2 2   ２パターン
    return count(array_unique(array_slice($ranks, 0, 4))) === 1 ||
      count(array_unique(array_slice($ranks, 1, 4))) === 1;
  }

  private function fullHouse(array $ranks): bool
  { //2枚、３枚のペアで揃っている   2 2 3 3 3   222 33    ２パターン
    return (count(array_unique(array_slice($ranks, 0, 2))) === 1 && count(array_unique(array_slice($ranks, 2, 3))) === 1) || (count(array_unique(array_slice($ranks, 0, 3))) === 1 && count(array_unique(array_slice($ranks, 3, 2))) === 1);
  }

  private function straight(array $ranks): bool
  {
    return $this->isStraight($ranks) || $this->firstStraight($ranks);
  }

  private function isStraight(array $ranks): bool
  {
    //通常のストレート条件　見直し　K-A-2
    // return abs($cardRank1 - $cardRank2) === 1 && abs($cardRank2 - $cardRank3) === 1;
    return range($ranks[0], $ranks[0] + count($ranks) - 1) === $ranks;
  }

  private function firstStraight(array $ranks): bool
  {
    //A-2-3が最弱のストレート, （QKAが最強）, 12-0-1 , 10-11,12 , K-A-2はハイカード
    return $ranks === [min(PokerCard::CARD_RANKS), min(PokerCard::CARD_RANKS) + 1, min(PokerCard::CARD_RANKS) + 2, min(PokerCard::CARD_RANKS) + 3, max(PokerCard::CARD_RANKS)];
  }
}
