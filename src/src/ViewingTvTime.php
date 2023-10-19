<?php
/*
//docker-compose exec app php quiz1.php 1 30 5 25 2 30 1 15

//○インプット例
//1 30 5 25 2 30 1 15
//○アウトプット例
//1.7
//1 45 2
//2 30 1
//5 25 1
//------------------------
//データ構造を決める
//    [ch => [min, min]], ch => [min, min], ...]
//ie. [1 => [30, 15]], 2 =>[30]]
*/


const SPLIT_LENGTH = 2;

function getInput($data)
{
  // $argument = [1, 30, 5, 25, 2, 30, 1, 15];
  $argument = array_slice($_SERVER['argv'], 1);
  return array_chunk($argument, SPLIT_LENGTH);
}


function groupChannelViewingPeriod(array $inputs): array
{
  $channelViewingPeriods = [];
  foreach ($inputs as $input) {
    //[[1.30]],[5,25]..... : foreachでループするのは一番外の配列を順にやっていくので注意
    $chan = $input[0];
    $min = $input[1];
    $mins = [$min];

    if (array_key_exists($chan, $channelViewingPeriods)) {
      $channelViewingPeriods[$chan] = array_merge($channelViewingPeriods[$chan], $mins);
    }

    $channelViewingPeriods[$chan] = $mins;
  }
  return $channelViewingPeriods;
}


function total($channelViewingPeriod)
{
  $total = [];
  foreach ($channelViewingPeriod as $min) {
    $total = array_merge($total, $min);
  }
  return $totalSum = array_sum($total);
}


function display($channelViewingPeriod)
{
  echo total($channelViewingPeriod) . PHP_EOL;
  foreach ($channelViewingPeriod as $ch => $min) {
    echo $ch . ' ' . array_sum($min) . ' ' . count($min) . PHP_EOL;
  }
}


$inputs = getInput();
$channelViewingPeriod = groupChannelViewingPeriod($inputs);
display($channelViewingPeriod);
