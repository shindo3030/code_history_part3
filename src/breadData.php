<?php

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

/**
 * @return array<int, mixed> $salesData
 */
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

/**
 * @param array<int ,mixed> $salesData
 * @return array<int, mixed> $maxValue
 */
function maxData(array $salesData): array
{
    $max = max(array_values($salesData));
    $maxValue =  array_keys($salesData, $max);
    return $maxValue;
}

/**
 * @param array<int, mixed> $salesData
 * @return array<int, mixed> $minValue
 */
function minData(array $salesData): array
{
    $min = min(array_values($salesData));
    $minValue = array_keys($salesData, $min);
    return $minValue;
}

/**
 * @param array<int, mixed> $salesData
 * @return int $total
 */
function totalData(array $salesData): int
{
    $total = 0;
    foreach ($salesData as $num => $salePrice) {
        $total += PANS_PRICE_LISTS[$num] * (int)$salePrice;
    }
    $total = (int)$total * (100 + TAX) / 100;
    return $total;
}

/**
 * @param array<int, mixed> $results
 * @return void
 */
// function display(array ...$results): void
// {
//     foreach ($results as $result) {
//         echo implode(' ', $result) . PHP_EOL;
//     }
// }

function display($results): void
{
    foreach ($results as $result) {
        echo implode(' ', $result) . PHP_EOL;
    }
}


$salesData = inputs();
$max = maxData($salesData);
$min = minData($salesData);
$total = totalData($salesData);
$results = [[$total], $max, $min];

// display([$total], $max, $min);
display($results);
