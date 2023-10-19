<?php
//  * ◯お題
//  * スーパーで買い物したときの支払金額を計算するプログラムを書きましょう。
//  * 以下の商品リストがあります。先頭の数字は商品番号です。金額は税抜です。
//  *計1,680円
//  * 1. 玉ねぎ 100円
//  * 2. 人参 150円
//  * 3. りんご 200円
//  * 4. ぶどう 350円
//  * 5. 牛乳 180円
//  * 6. 卵 220円
//  * 7. 唐揚げ弁当 440円
//  * 8. のり弁 380円
//  * 9. お茶 80円
//  * 10. コーヒー 100円
//  *
//  * また、以下の条件を満たすと割引されます。
//  *
//  * a. 玉ねぎは3つ買うと50円引き
//  * b. 玉ねぎは5つ買うと100円引き
//  * c. 弁当と飲み物を一緒に買うと20円引き（ただし適用は一組ずつ）
//  * d. お弁当は20〜23時はタイムセールで半額

const ITEMS = [
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

function calc(string $time, array $items): int
{
    $price = 0;
    $drinkValues = 0;
    $bentoValues = 0;
    $bentoAmount = 0;
    foreach ($items as $item) {
        if (ITEMS[$item]['type'] === 'drink') {
            $drinkValues += 1;
        } elseif (ITEMS[$item]['type'] === 'bento') {
            $bentoValues += 1;
            $bentoAmount += ITEMS[$item]['price'];
        }
    }

    $price = total($items);
    $price -= discountOnion(array_count_values($items)[1]);
    $price -= discountSet($drinkValues, $bentoValues);
    $price -= discountTimeSale($time, $bentoAmount);
    return $price * (TAX + 100) / 100;
}

function total(array $items): int
{
    $total = 0;
    foreach ($items as $itemNum) {
        $total += ITEMS[$itemNum]['price'];
    }
    return $total;
}

function discountOnion(int $onionCount): int
{
    $discountOnion = 0;
    if ($onionCount >= 5) {
        $discountOnion = 100;
    } elseif ($onionCount >= 3) {
        $discountOnion = 50;
    } else {
        return 0;
    }
    return $discountOnion;
}

function discountSet(int $drinkValues, int $bentoValues): int
{
    $discountSet = 0;
    $discountSet = 20 * min($drinkValues, $bentoValues);
    return $discountSet;
}

function discountTimeSale(string $time, int $bentoAmount): int
{
    if (strtotime('20:00') <= strtotime($time) && strtotime($time) <= strtotime('23:00')) {
        return $bentoAmount = $bentoAmount / 2;
    } else {
        return (int) 0;
    }
}
