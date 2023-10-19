<?php

const ITEM_LIST = [
  1 => 100,
  2 => 150,
  3 => 200,
  4 => 350,
  5 => 180,
  6 => 220,
  7 => 440,
  8 => 380,
  9 => 80,
  10 => 100,
];
const TAX = 10;
/*
  弁当：7,8　飲み物：5,9,10　その他：1,2,3,4,6
１、玉ねぎ　２、人参　３、りんご　４、ぶどう　５、牛乳　６、卵　７、唐揚げ弁当　８、のり弁　９、お茶　１０、コーヒー
玉ねぎは３つ買うと、５０円引き
玉ねぎは５つ買うと、１００円引き
弁当と飲み物を一緒に買うと２０円引き（ただし適用は一組組ずつ）
お弁当は２０時〜２３時はタイムセールで半額

calcメソッドを実行（購入時刻　商品番号 商品番号 ...）を引数に取り、合計金額（税込み）を返します。
**実行例：calc('21:00',[1,1,1,3,5,7,8,9,10]) //=> 1298
*/


function total($itemNumbers)
{
  $totalValue = 0;
  foreach ($itemNumbers as $itemNum) {
    $totalValue += ITEM_LIST[$itemNum];
  }
  return $totalValue;
}

function discount($date, $itemNumbers, $lunchBoxCountValues, $drinkCountValues, $etcCountValues)
{
  $totalValue = 0;
  $totalValue = total($itemNumbers);

  foreach ($etcCountValues as $etcKey => $etcQuantitiy) {
    //玉ねぎ[1]は３つ買うと、５０円引き
    if ($etcKey === 1 && $etcQuantitiy >= 3) {
      $totalValue -= 50;
      //玉ねぎ[1]は３つ買うと、10０円引き 　　米見直し
    } elseif ($etcKey === 1 && $etcQuantitiy >= 5) {
      $totalValue -= 100;
    }
  }
  /*
  // 弁当[7,8]と飲み物[5,9,10]を一緒に買うと２０円引き（ただし適用は一組組ずつ）
  // 弁当配列と飲み物配列それぞれの買った合計数を比較（どちらかの最小合計数分２０円引きをしていく）
*/
  $lunchBoxValue = array_sum($lunchBoxCountValues);
  $drinkValue = array_sum($drinkCountValues);

  if ($lunchBoxValue > $drinkValue) {
    $totalValue = $totalValue - (20 * $drinkValue);
  } elseif ($drinkValue > $lunchBoxValue) {
    $totalValue = $totalValue - (20 * $lunchBoxValue);
  } elseif ($lunchBoxValue === $drinkValue) {
    $totalValue = $totalValue - (20 * $lunchBoxValue);
  }
  /*
  // //お弁当[7,8]は２０時〜２３時はタイムセールで半額
*/
  $inputDateTime = new DateTime($date);
  $dateTime1 = new DateTime('20:00');
  $dateTime2 = new DateTime('23:00');
  if ($dateTime1 <= $inputDateTime && $inputDateTime <= $dateTime2) {
    /*
  //   //お弁当配列の入った変数の要素数分だけトータルから半額にしていく
*/
    foreach ($lunchBoxCountValues as $lunchBoxKey => $lunchBoxquantity) {
      if ($lunchBoxKey === 7) {
        $totalValue = $totalValue - ((440 / 2) * $lunchBoxquantity);
      } elseif ($lunchBoxKey === 8) {
        $totalValue = $totalValue - ((380 / 2) * $lunchBoxquantity);
      }
    }
  }
  //税率１０％
  $totalValue = $totalValue * (100 + TAX) / 100;
  return $totalValue;
}


function inputSorting($itemNumbers)
{
}


function calc(string $date, array $itemNumbers)
{
  //弁当：7,8　飲み物：5,9,10　その他：1,2,3,4,6
  $lunchBox = [];
  $drink = [];
  $etc = [];

  foreach ($itemNumbers as $itemNum) {
    $item = $itemNum;

    if ($item === 7 || $item === 8) {
      $l = $item;
      $lunchBoxInput = array($l);
      $lunchBox = array_merge($lunchBox, $lunchBoxInput);
    } elseif ($item === 5 || $item === 9 || $item === 10) {
      $d = $item;
      $drinkInput = [$d];
      $drink = array_merge($drink, $drinkInput);
    } else {
      $e = $item;
      $etcInput = [$e];
      $etc = array_merge($etc, $etcInput);
    }
  }

  $lunchBoxCountValues = array_count_values($lunchBox);
  $drinkCountValues = array_count_values($drink);
  $etcCountValues = array_count_values($etc);
  // var_dump($lunchBoxCountValues);
  // var_dump($drinkCountValues);
  // var_dump($etcCountValues);


  $totalValue = total($itemNumbers);
  $discount = discount($date, $itemNumbers, $lunchBoxCountValues, $drinkCountValues, $etcCountValues);
  echo $discount . PHP_EOL;
}


$inputDate = '21:00';
$inputItem = [1, 1, 1, 3, 5, 7, 8, 9, 10];
//弁当：7,8　飲み物：5,9,10　その他：1,2,3,4,6
//お弁当、飲み物、その他で配列を別々に分ける
calc($inputDate, $inputItem);
//お会計金額、1298と出力されれば正解
//税率10%
