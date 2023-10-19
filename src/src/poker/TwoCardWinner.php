<?php

namespace poker;


require_once('WinnersRule.php');

class TwoCardWinner implements WinnersRule
{
  public function getWin(array $handRoles): int
  {
    $player1 = $handRoles[0];
    $player2 = $handRoles[1];

    foreach (['rank', 'primary', 'secondary'] as $key) {
      if ($player1[$key] > $player2[$key]) {
        return 1;
      }
      if ($player1[$key] < $player2[$key]) {
        return 2;
      }
    }
    return 0;
  }
}
