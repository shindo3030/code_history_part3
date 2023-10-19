<?php
/*
// show('CK', 'DJ', ,'H9', 'C10', 'H10', 'D3');  //=> ['high card', 'pair', 2]
// show('CK', 'DA', 'H2', 'C3', 'H4', 'S5');     //=> ['high card', 'straight', 2]
// show('CK', 'DJ', 'H9', 'C3', 'H3', 'S3');     //=> ['high card', 'three card', 2]
// show('C3', 'H4', 'S5', 'DK', 'SK', 'D10');    //=> ['straight', 'pair', 1]
// show('C3', 'H3', 'S3', 'DK', 'SK', 'D10');    //=> ['three card', 'pair', 1]
// show('C3', 'H3', 'S3', 'DK', 'SJ', 'DQ');     //=> ['three card', 'straight', 1]
// show('HJ', 'SK', 'D9', 'DQ', 'D10', 'H8');    //=> ['high card', 'high card', 1]
// show('H9', 'SK', 'H7', 'DK', 'D10', 'H5');    //=> ['high card', 'high card', 2]
// show('H9', 'SK', 'H7', 'DK', 'D9', 'H5');     //=> ['high card', 'high card', 1]
// show('H3', 'S5', 'C7', 'D5', 'S7', 'D3');     //=> ['high card', 'high card', 0]
// show('CA', 'DA', 'DK', 'C2', 'D2', 'C3');     //=> ['pair', 'pair', 1]
// show('CK', 'DK', 'SA', 'CA', 'DA', 'SK');     //=> ['pair', 'pair', 2]
// show('C4', 'D4', 'S7', 'H4', 'S4', 'C6');     //=> ['pair', 'pair', 1]
// show('C4', 'D4', 'S7', 'H4', 'S4', 'C7');     //=> ['pair', 'pair', 0]
// show('SA', 'DK', 'DQ', 'CA', 'C2', 'D3');     //=> ['straight', 'straight', 1]
// show('SA', 'DK', 'DQ', 'CK', 'CQ', 'DJ');     //=> ['straight', 'straight', 1]
// show('S2', 'H3', 'D4', 'CA', 'C2', 'D3');     //=> ['straight', 'straight', 1]
// show('S2', 'S3', 'S4', 'C2', 'C3', 'D4');     //=> ['straight', 'straight', 0]
// show('S2', 'C2', 'D2', 'CA', 'HA', 'SA');    //=> ['three card', 'three card', 2]
// show('SK', 'CK', 'DK', 'CA', 'HA', 'SA');     //=> ['three card', 'three card', 2]
// show('S2', 'C2', 'D2', 'C3', 'H3', 'S3');     //=> ['three card', 'three card', 2]
*/


const CARDS = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];

define('CARD_RANKS', (function () {
  $cardRanks = [];
  foreach (CARDS as $index => $card) {
    $cardRanks[$card] = $index;
  }
  return $cardRanks;
})());

const HIGH_CARD = 'high card';
const PAIR = 'pair';
const STRAIGHT = 'straight';
const THREECARD = 'three card';

const RANKS = [
  HIGH_CARD => 1,
  PAIR => 2,
  STRAIGHT => 3,
  THREECARD => 4,
];

function showDown(string $card11, string $card12, string $card13, string $card21, string $card22, string $card23)
{
  //カードをランクに変換
  $cardRank = convertToRank([$card11, $card12, $card13, $card21, $card22, $card23]);
  $cardRanks = array_chunk($cardRank, 3);

  //３カード用　ランクの強い順に並び替え
  rsort($cardRanks[0], SORT_NUMERIC);
  rsort($cardRanks[1], SORT_NUMERIC);

  //カードロールジャッジ array_mapは配列の一番上の階層でループがされる($cardRanks)
  $roleData = array_map(fn ($cardRank) => roleJudge($cardRank[0], $cardRank[1], $cardRank[2]), $cardRanks);
  //勝敗
  $win = winner($roleData[0], $roleData[1]);
  return [$roleData[0]['name'], $roleData[1]['name'], $win];
}


function convertToRank(array $cards)
{
  return array_map(fn ($card) => CARD_RANKS[substr($card, 1, strlen($card) - 1)], $cards);
}


function roleJudge(int $cardRank1, int $cardRank2, int $cardRank3): array
{
  $primary = $cardRank1;
  $secondary = $cardRank2;
  $thrd = $cardRank3;
  $name =  HIGH_CARD;

  if (threeCard($cardRank1, $cardRank2, $cardRank3)) {
    $name = THREECARD;
  } elseif (pair($cardRank1, $cardRank2, $cardRank3)) {
    $name = PAIR;
    if (isMinMaxPair($cardRank2, $cardRank3)) {
      $primary = $cardRank2;
      $secondary = $cardRank3;
      $thrd = $cardRank1;
    }
  } elseif (straight($cardRank1, $cardRank2, $cardRank3) || isMinMax($cardRank1, $cardRank2, $cardRank3)) {
    $name = STRAIGHT;
    if (isMinMax($cardRank1, $cardRank2, $cardRank3)) {
      //Aが最小値として扱われる場合 A - 2 の役の時 primary:0 secondary:13
      //$primary=$cardRank2, $secondary=$cardRank3, $thrd=$cardRank1
      $primary = $cardRank2;
      $secondary = $cardRank3;
      $thrd = 0;
    }
  }

  return [
    'name' => $name,
    'rank' => RANKS[$name],
    'primary' => $primary,
    'secondary' => $secondary,
    'thrd' => $thrd,
  ];
}

function threeCard($cardRank1, $cardRank2, $cardRank3)
{
  return $cardRank1 === $cardRank2 && $cardRank1 === $cardRank3 && $cardRank2 === $cardRank3;
}

function pair($cardRank1, $cardRank2, $cardRank3)
{
  return ($cardRank1 === $cardRank2) || ($cardRank2 === $cardRank3) || ($cardRank1 === $cardRank3);
}

function isMinMaxPair($cardRank2, $cardRank3)
{
  return $cardRank2 === $cardRank3;
}

function straight($cardRank1, $cardRank2, $cardRank3)
{
  return isStraight($cardRank1, $cardRank2, $cardRank3) || isMinMax($cardRank1, $cardRank2, $cardRank3);
}

function isStraight($cardRank1, $cardRank2, $cardRank3)
{
  //通常のストレート条件　見直し　K-A-2
  return abs($cardRank1 - $cardRank2) === 1 && abs($cardRank2 - $cardRank3) === 1;
}

function isMinMax($cardRank1, $cardRank2, $cardRank3)
{
  //A-2-3が最弱のストレート, （QKAが最強）, 12-0-1 , 10-11,12 , K-A-2はハイカード
  return $cardRank1 === 12 && $cardRank2 === 1 && $cardRank3 === 0;
  // return abs($cardRank1 - $cardRank3) === abs(max(CARD_RANKS) - min(CARD_RANKS));
}


function winner(array $role1, array $role2): int
{
  foreach (['rank', 'primary', 'secondary', 'thrd'] as $key) {
    if ($role1[$key] > $role2[$key]) {
      return 1;
    }
    if ($role1[$key] < $role2[$key]) {
      return 2;
    }
  }
  return 0;
}
