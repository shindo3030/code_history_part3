<?php

function judge($correct, $answer)
{
  $hit = 0;
  $brow = 0;
  $answerArray = str_split((string)$answer);
  foreach ($answerArray as $index => $letter) {
    if (hitJudge($correct, $index, $letter)) {
      $hit++;
    }
    //hitの条件以外の時にbrow
    if (browJudge($correct, $index, $letter)) {
      $brow++;
    }
  }
  return [$hit, $brow];
}

function hitJudge($correct, $index, $letter)
{
  return (str_split((string)$correct)[$index] === $letter);
}

function browJudge($correct, $index, $letter)
{
  if (hitJudge($correct, $index, $letter)) {
    return false;
  }
  return true;
}
