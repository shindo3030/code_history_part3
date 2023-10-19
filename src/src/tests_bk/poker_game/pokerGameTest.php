<?php

namespace poker\Tests;


use PHPUnit\Framework\TestCase;
use poker\PokerGame as PokerGame;

require_once(__DIR__ . '/../../lib/poker/pokerGame.php');
// require_once(__DIR__ . '/../../lib/poker/PokerCard.php');
// require_once(__DIR__ . '/../../lib/poker/RoleJudge.php');

class PokerGameTest extends TestCase
{
  public function testStart()
  {

    //カード2枚の場合
    $game1 = new PokerGame(['CA', 'DA'], ['C9', 'H10']);
    $this->assertSame(['pair', 'straight', 2], $game1->start());

    //カード3枚の場合
    $game2 = new PokerGame(['C2', 'D2', 'S2'], ['C10', 'H9', 'DJ']);
    $this->assertSame(['three card', 'straight', 1], $game2->start());

    //カード5枚の場合
    // $game3 = new PokerGame(['C2', 'D2', 'S2', 'H2', 'C3'], ['C10', 'H9', 'DK', 'DQ', 'SJ']);
    // $this->assertSame(['four of a kind', 'straight'], $game3->start());
  }
}
