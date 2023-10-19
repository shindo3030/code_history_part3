<?php

namespace poker\Tests;

use PHPUnit\Framework\TestCase;
use poker\TwoCardWinner as TwoCardWinner;

require_once(__DIR__ . '/../../lib/poker/TwoCardWinner.php');

class TwoCardWinnerTest extends TestCase
{
  public function testGetWin()
  {
    $winRule = new TwoCardWinner();
    //カード2枚の場合
    $this->assertSame(2, $winRule->getWin([[
      'name' => 'pair',
      'rank' => 2,
      'primary' => 13,
      'secondary' => 13,
    ], [
      'name' => 'straight',
      'rank' => 3,
      'primary' => 9,
      'secondary' => 8,
    ]]));
  }
}
