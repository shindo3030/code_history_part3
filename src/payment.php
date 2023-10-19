<?php

const ITEM_LIST = [
    1 => ['price' => 100, 'type' => ''],
    2 => ['price' => 150, 'type' => ''],
    3 => ['price' => 200, 'type' => ''],
    4 => ['price' => 350, 'type' => ''],
    5 => ['price' => 180, 'type' => 'drink'],
    6 => ['price' => 220, 'type' => ''],
    7 => ['price' => 440, 'type' => 'bento'],
    8 => ['price' => 380, 'type' => 'bento'],
    9 => ['price' => 80, 'type' => 'drink'],
    10 => ['price' => 100, 'type' => 'drink'],
];
const TAX = 10;


function calc(string $date, array $itemNumbers)
{

    $drinkTotalPrice = 0;
    $bentoTotalPrice = 0;
    $drinkCount = 0;
    $bentoCount = 0;
    foreach ($itemNumbers as $itemNum) {
        if ('drink' === ITEM_LIST[$itemNum]['type']) {
            $drinkCount++;
            $drinkTotalPrice +=  ITEM_LIST[$itemNum]['price'];
        }
        if ('bento' === ITEM_LIST[$itemNum]['type']) {
            $bentoCount++;
            $drinkTotalPrice += ITEM_LIST[$itemNum]['price'];
        }
    }
    $totalValue = 0;
    $totalValue = total($itemNumbers);

    $totalValue -= discountOnion(array_count_values($itemNumbers)[1]);
    $totalValue -= discountSet($drinkCount, $bentoCount);
    $totalValue -= discountBento($date, $bentoTotalPrice);

    // return (int)$totalValue * (100 + TAX) / 100;
    $totalValue = (int)$totalValue * (100 + TAX) / 100;
    echo $totalValue;
}

function total(array $itemNumbers): int
{
    $totalValue = 0;
    foreach ($itemNumbers as $itemNum) {
        $totalValue += ITEM_LIST[$itemNum]['price'];
    }
    return $totalValue;
}

function discountOnion(int $itemNumOnion): int
{
    $discount = 0;

    //玉ねぎ[1]は３つ買うと、100円引き
    if ($itemNumOnion === 1) {
        if ($itemNumOnion >= 5) {
            $discount = 100;
            //玉ねぎ[1]は３つ買うと、５０円引き
        } elseif ($itemNumOnion >= 3) {
            $discount = 50;
        }
    }

    return $discount;
}


function discountSet(int $drinkCount, int $bentoCount): int
{
    return 20 * min([$drinkCount, $bentoCount]);
}


function discountBento(string $date, int $bentoTotalPrice): int
{
    //20:00未満だった時点で関数から抜ける
    if (strtotime('20:00') > strtotime($date)) {
        return 0;
    }
    return $bentoTotalPrice / 2;
}


$date = '21:00';
$itemNumbers = [1, 1, 1, 3, 5, 7, 8, 9, 10];
calc($date, $itemNumbers);
