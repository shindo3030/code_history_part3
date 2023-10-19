<?php

function judge($correct, $answer)
{
  $hitCount = 0;
  $browCount = 0;
  $answerArray = str_split((string)$answer);

  foreach ($answerArray as $index => $letter) {
    if (hitCondition($correct, $index, $letter)) {
      $hitCount++;
    }
    if (browCondition($correct, $index, $letter)) {
      $browCount++;
    }
  }
  return [$hitCount, $browCount];
}

function hitCondition(string $correct, int $index, string $letter): bool
{
  return str_split($correct)[$index] === $letter;
}

function browCondition(string $correct, int $index, string $letter): bool
{
  if (hitCondition($correct, $index, $letter)) {
    return false;
  }
  return in_array($letter, str_split((string)$correct), true);
}
