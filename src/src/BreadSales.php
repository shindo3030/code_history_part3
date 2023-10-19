<?php
// *インプット例*
// docker-compose exec app php sample2.php 1 10 2 3 5 1 7 5 10 1
// *アウトプット例*
// 2464
// 1
// 5 10

// ▼データ構造
// ・要素名に商品番号、要素に値段が格納された配列を作成（グローバル変数or定数）
// priceDataLists = [
// 1 => 100,
// 2 => 120,
// 3 => 150,
// 4 => 250,
// 5 => 80,
// 6 => 120,
// 7 => 100,
// 8 => 180,
// 9 => 50,
// 10 => 300,
// ];
// ・インプットで受け取ったデータについては
// 要素名に商品番号、要素に値段が格納された配列に置き換える
// 1 10 2 3 5 1 7 5 10 1
// input = [
// 1 => 10,
// 2 => 3,
// 5 => 1,
// 7 => 5,
// 10 => 1,
// ];
// ＊合計の値段の出力
// インプットデータのkey名と商品リストの配列は商品番号の要素名が一致しているので
// foreachでそれぞれのインプットデータ＊対象の商品リストの要素を指定して結果を$totalPriceへ代入し順に加算していく

// ＊最小最大値の出力
// 配列の最大値はmax(value)、最小値はmin(value)で導き出せる
// 最大最小で重複した場合は、（割り出した最小値、最大値を変数に入れ
// インプットされたデータの配列をforeachを行い、もし取得した最小、最大値と等しい要素のみkeyを全て出力する）
// */
//税率は10% = 1.10 ( (100% + 10%)/100 )
const TAX = 10;
const PANS_PRICE_LISTS = [
  1 => 100,
  2 => 120,
  3 => 150,
  4 => 250,
  5 => 80,
  6 => 120,
  7 => 100,
  8 => 180,
  9 => 50,
  10 => 300
];

function inputs(): array
{
  $inputs = array_slice($_SERVER['argv'], 1);
  $inputs = array_chunk($inputs, 2);

  $salesData = [];
  foreach ($inputs as $input) {
    $salesData[$input[0]] = $input[1];
  }
  return $salesData;
}

function maxData(array $salesData): array
{
  $max = max(array_values($salesData));
  return array_keys($salesData, $max);
}

function minData(array $salesData): array
{
  $min = min(array_values($salesData));
  return array_keys($salesData, $min);
}

function totalData(array $salesData): int
{
  $total = 0;
  foreach ($salesData as $num => $salePrice) {
    $total += PANS_PRICE_LISTS[$num] * (int)$salePrice;
  }
  return (int)$total * (100 + TAX) / 100;
  // return $total;
}

function display(array ...$results): void
{
  foreach ($results as $result) {
    echo implode(' ', $result) . PHP_EOL;
  }
}

$salesData = inputs();
$max = maxData($salesData);
$min = minData($salesData);
$total = totalData($salesData);
display([$total], $max, $min);
