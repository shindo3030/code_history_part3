<?php

const SPLIT_LENGTH = 2;

/**
 * @return array<int, mixed> $argument
 */
function getInput(): array
{
    $argument = array_slice($_SERVER['argv'], 1);
    $argument = array_chunk($argument, SPLIT_LENGTH);
    return $argument;
}

/**
 * @param array<int, mixed> $inputs
 * @return array<int, mixed> $channelViewingPeriods
 */
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

/**
 * @param array<int, mixed> $channelViewingPeriod
 * @return float $totalValue
 */
function total($channelViewingPeriod)
{
    $totalValue = 0;
    $total = [];
    foreach ($channelViewingPeriod as $min) {
        $total = array_merge($total, $min);
    }
    $totalValue = round(array_sum($total) / 60, 1);
    return $totalValue;
}

/**
 * @param array<int, mixed> $channelViewingPeriod
 * @return void
 */
function display(array $channelViewingPeriod): void
{
    echo total($channelViewingPeriod) . PHP_EOL;
    foreach ($channelViewingPeriod as $ch => $min) {
        echo $ch . ' ' . array_sum($min) . ' ' . count($min) . PHP_EOL;
    }
}

$inputs = getInput();
$channelViewingPeriod = groupChannelViewingPeriod($inputs);
display($channelViewingPeriod);
