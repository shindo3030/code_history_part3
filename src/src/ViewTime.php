<?php

const SPLIT_LENGTH = 2;

function getInput(array $argv): array
{
  $argument = array_slice($argv, 1);
  return array_chunk($argument, SPLIT_LENGTH);
}


function groupChannelViewingPeriod(array $inputs): array
{
  $channelViewingPeriods = [];
  foreach ($inputs as $input) {
    $chan = $input[0];
    $min = $input[1];
    $mins = [$min];

    if (array_key_exists($chan, $channelViewingPeriods)) {
      $channelViewingPeriods[$chan] = array_merge($channelViewingPeriods[$chan], $mins);
    } else {
      $channelViewingPeriods[$chan] = $mins;
    }
  }
  return $channelViewingPeriods;
}


function totalTimes($channelViewingPeriod)
{
  $total = [];
  foreach ($channelViewingPeriod as $min) {
    $total = array_merge($total, $min);
  }
  return round(array_sum($total) / 60, 1);
}


function display($channelViewingPeriod)
{
  echo totalTimes($channelViewingPeriod) . PHP_EOL;
  foreach ($channelViewingPeriod as $ch => $min) {
    echo $ch . ' ' . array_sum($min) . ' ' . count($min) . PHP_EOL;
  }
}


$inputs = getInput($_SERVER['argv']);
$channelViewingPeriod = groupChannelViewingPeriod($inputs);
display($channelViewingPeriod);
