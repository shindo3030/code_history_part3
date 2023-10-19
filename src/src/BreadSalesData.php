<?php

const DIVISION_NUMBER = 2;
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
  10 => 300,
];

function chunkInputs(array $argv): array
{
  $inputs = array_slice($argv, 1);
  $inputs = array_chunk($inputs, DIVISION_NUMBER);

  $salesData = [];
  foreach ($inputs as $input) {
    $salesData[$input[0]] = $input[1];
  }
  return $salesData;
}

function maxData(array $salesData): array
{
  if (empty($salesData)) {
    return [];
  }

  $maxValues = max(array_values($salesData));
  return array_keys($salesData, $maxValues);
}

function minData(array $salesData): array
{
  if (empty($salesData)) {
    return [];
  }

  $minValues = min(array_values($salesData));
  return array_keys($salesData, $minValues);
}

function totalData(array $salesData): int
{
  $total = 0;
  foreach ($salesData as $num => $salePrice) {
    $total +=  PANS_PRICE_LISTS[$num] * (int)$salePrice;
  }
  return (int)$total * (100 + TAX) / 100;
}

function displayResult(array ...$results): void
{
  foreach ($results as $result) {
    echo implode(' ', $result) . PHP_EOL;
  }
}

$salesData = chunkInputs($_SERVER['argv']);
$maxValues = maxData($salesData);
$minValues = minData($salesData);
$total = totalData($salesData);
displayResult([$total], $maxValues, $minValues);
