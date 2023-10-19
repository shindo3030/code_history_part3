<?php
//No3

// const CARDS = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];

// define('CARD_RANKS', (function () {
//   $cardRanks = [];
//   foreach (CARDS as $index => $card) {
//     $cardRanks[$card] = $index;
//   }
// })());

// const HIGH_CARD = 'high card';
// const PAIR = 'pair';
// const STRAIGHT = 'straight';

// const RANKS = [
//   HIGH_CARD => 1,
//   PAIR => 2,
//   STRAIGHT => 3,
// ];

// function showDown(string $card11, string $card12, string $card21, string $card22)
// {
//   //カードをランクに変換
//   $cardRank = convertToRank([$card11, $card12, $card21, $card22]);
//   $cardRanks = array_chunk($cardRank, 2);
//   //カードロールジャッジ
//   $roleData = array_map(roleJudge($cardRank[0], $cardRank[1]), $cardRanks);
//   //勝敗
//   $win = winner($roleData[0], $roleData[1]);
//   return [$roleData[0]['name'], $roleData[1]['name'], $win];
// }


// function convertToRank(array $cards): array
// {
//   return array_map(fn ($card) => CARD_RANKS[substr($card, 1, strlen($card) - 1)], $cards);
// }


// function roleJudge(array $cardRank1, array $cardRank2): array
// {
//   $primary = max($cardRank1, $cardRank2);
//   $secondary = min($cardRank1, $cardRank2);
//   $name =  HIGH_CARD;

//   if (pair($cardRank1, $cardRank2)) {
//     $name = PAIR;
//   } elseif (straight($cardRank1, $cardRank2)) {
//     $name = STRAIGHT;
//     if (isMinMax($cardRank1, $cardRank2)) {
//       //Aが最小値として扱われる場合 A - 2 の役の時 primary:0 secondary:13
//       $primary = min($cardRank1, $cardRank2);
//       $secondary = max($cardRank1, $cardRank2);
//     }
//   }

//   return [
//     'name' => $name,
//     'rank' => RANKS[$name],
//     'primary' => $primary,
//     'secondary' => $secondary,
//   ];
// }



// function pair($cardRank1, $cardRank2)
// {
//   return $cardRank1 === $cardRank2;
// }

// function straight($cardRank1, $cardRank2)
// {
//   return abs($cardRank1 - $cardRank2) === 1 || isMinMax($cardRank1, $cardRank2);
// }

// function isMinMax($cardRank1, $cardRank2)
// {
//   return abs($cardRank1 - $cardRank2) === abs(max(CARD_RANKS) - min(CARD_RANKS));
// }


// function winner(array $role1, array $role2): int
// {
//   foreach (['rank', 'primary', 'secondary'] as $key) {
//     if ($role1[$key] > $role2[$key]) {
//       return 1;
//     }
//     if ($role1[$key] < $role2[$key]) {
//       return 2;
//     }
//   }
//   return 0;
// }






//No2
// const CARDS = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];
// define('CARDS_RANKS', (function () {
//   $cardsRanks = [];
//   foreach (CARDS as $index => $card) {
//     $cardsRanks[$card] = $index;
//   }
// }));

// const HIGH_CARD = 'high card';
// const PAIR = 'pair';
// const STRAIGHT = 'straight';

// const ROLE_RANKS= [
//   HIGH_CARD => 1,
//   PAIR => 2,
//   STRAIGHT => 3,
// ]

// function showDown(string $card11, string $card12, string $card21, string $card22)
// {

//   //データ構造の成形
//   $cardRank = convertToRank([$card11, $card12, $card21, $card22]);
//   $cardRanks = array_chunk($cardRank, 2);

//   //各手札をジャッジ
//   $judgeData = roleJudge($cardRanks[0],$cardRanks(1));
//   //勝敗をジャッジ
//   $win = winner($judgeData[0], $judgeData[1]);
//   return [$judgeData[0]['name'], $judgeData[1]['name'],$win];
// }

// function convertToRank(array $cards): array
// {
//   return array_map(fn ($card) => CARDS_RANKS[substr($card, 1, strlen($card) - 1)], $cards);
// }


// function roleJudge(array $cardRank1, array $cardRank2): array
// {

//   $primary = max($cardRank1, $cardRank2);
//   $secondary = min($cardRank1, $cardRank2);
//   $name = HIGH_CARD;

//   if(STRAIGHT($cardRank1, $cardRank2)){
//     $name = STRAIGHT;
//     if(isMinMax($cardRank1, $cardRank2)){
//       $primary = min($cardRank1, $cardRank2);
//       $secondary = max($cardRank1, $cardRank2);
//     }
//   }elseif(PAIR($cardRank1, $cardRank2)){
//       $name = PAIR;
//   }

//   return [
//     'name' => $name,
//     'rank' => ROLE_RANKS[$name],
//     'primary' => $primary,
//     'secondary' => $secondary,
//   ];
// }


// function STRAIGHT($cardRank1, $cardRank2){
//   return abs($cardRank1 > $cardRank2)===1 || isMinMax($cardRank1, $cardRank2)
// }

// function isMinMax($cardRank1, $cardRank2){
//   return abs($cardRank1, $cardRank2) === abs(max(CARD_RANKS) - min(CARD_RANKS));
// }


// function PAIR($cardRank1, $cardRank2){
//   return $cardRank1 === $cardRank2;
// }


// function winner($player1,$player2){

//   foreach([$rank,$primary,$secondary] as $key){
//     if ($player1[$key] > $player2[$key]) {
//       return 1;
//     }
//     elseif ($player1[$key] < $player2[$key]) {
//       return 2;
//     }
//   }
//   return 0;

// }




/////No1

// const CARDS = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];
// define('CARD_RANKS', function () {
//   $cardRanks = [];
//   foreach (CARDS as $index => $card) {
//     $cardRanks[$card] = $index;
//   }
//   return $cardRanks;
// });

// const HIGH_CARD = 'high card';
// const PAIR = 'pair';
// const STRAIGHT = 'straight';

// const ROLE_RANKS =[
// HIGH_CARD => 1,
// PAIR => 2,
// STRAIGHT => 3,
// ]

// function sssssssshowDown(string $card11, string $card12, string $card21, string $card22)
// {

//   $cardRank = convertToCards($card11, $card12, $card21, $card22);
//   $cardRanks = array_chunk($cardRank, 2);

//   $hands = array_map(fn($cardRank)=>handsJudge($cardRank[0], $cardRank[1]), $cardRanks);

//   $winner = winner($hands[0], $hands[1])

//   return [$hands[0]['name'], $hands[1]['name'],$winner];
// }

// function convertToCards(array $cards)
// {
//   return array_map(fn ($card) => CARD_RANKS[substr($card, 1, strlen($card) - 1)], $cards);
// }


// handsJudge(int $handRank1,int $handRank2):array{
//   //cardRank1が呼ばれている時のcardRank2に何が入っているかを確かめる、同時には呼び出せないため（予想：ブランク）
//   $primary = max($handRank1, $handRank2);
//   $secondary = min($handRank1, $handRank2);

//   if(STRAIGHT($handRank1, $handRank2)){
//     $name = STRAIGHT;
//     if(isMinMax($handRank1, $handRank2)){
//       $primary = min(CARD_RANKS);
//       $secondary = max(CARD_RANKS);
//     }
//   }elseif(PAIR($handRank1, $handRank2)){
//     $name = PAIR;
//   }else{
//     $name = HIGH_CARD;
//   }

//   return [
//     'name' => $name,
//     'rank' => ROLE_RANKS[$name],
//     'primary' => $primary,
//     'secondary' => $secondary,
//   ];
// }

// function pair($handRank1, $handRank2){
//   return $handRank1 === $handRank2;
// }

// function straight($handRank1, $handRank2){
//   return abs($handRank1-$handRank2) === 1 || isMinMax($handRank1, $handRank2)
// }

// function isMinMax($handRank1, $handRank2){
//   return abs($handRank1 - $handRank2) === max(CARD_RANKS) - min(CARD_RANKS);
// }

// function winner($hand1,$hand2){
//   foreach(['rank','primary','secondary'] as $key){
//     if($hand1[$key] > $hand2[$key]){
//       return 1;
//     } elseif ($hand1[$key] < $hand2[$key]) {
//       return 2;
//   }
// }
// return 0;

// }
