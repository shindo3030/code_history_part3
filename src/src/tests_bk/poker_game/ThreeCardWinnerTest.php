<?php

namespace poker\Tests;

use PHPUnit\Framework\TestCase;
use poker\ThreeCardWinner as ThreeCardWinner;

require_once(__DIR__ . '/../../lib/poker/ThreeCardWinner.php');

class ThreeCardWinnerTest extends TestCase
{
  public function testGetWin()
  {
    $winRule = new ThreeCardWinner();
    //カード2枚の場合
    $this->assertSame(2, $winRule->getWin([[
      'name' => 'pair',
      'rank' => 2,
      'primary' => 13,
      'secondary' => 13,
      'thrd' => 9,
    ], [
      'name' => 'straight',
      'rank' => 3,
      'primary' => 10,
      'secondary' => 9,
      'thrd' => 8,
    ]]));
  }
}
