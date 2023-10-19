<?php

namespace blackJack\Tests;

use PHPUnit\Framework\TestCase;

use blackJack\BlackJackWinnersBeginnerRule as BlackJackWinnersBeginnerRule;
use blackJack\BlackJackWinnersJudge as BlackJackWinnersJudge;

require_once(__DIR__ . '/../../lib/blackjack/BlackJackWinnersBeginnerRule.php');
require_once(__DIR__ . '/../../lib/blackjack/BlackJackWinnersJudge.php');
require_once(__DIR__ . '/../../lib/blackjack/BlackJackWinnersRule.php');

class BlackJackWinnersJudgeTest extends TestCase
{
  public function testWinnersJudgeRun()
  {
    $BlackJackWinnersBeginnerRule = new BlackJackWinnersBeginnerRule;
    $winnersRule = new BlackJackWinnersJudge($BlackJackWinnersBeginnerRule);

    $BlackJackWinnersBeginnerRule->winnerJudge = [];
    $playersPoint = [21, 17, 17, 18];
    $this->assertSame('ディーラーの勝ちです。|ディーラーの勝ちです。|ディーラーの勝ちです。', $winnersRule->winnersJudgeRun($playersPoint));

    $BlackJackWinnersBeginnerRule->winnerJudge = [];
    $playersPoint = [20, 21, 21, 21];
    $this->assertSame('プレイヤー1の勝ちです。|プレイヤー2の勝ちです。|プレイヤー3の勝ちです。', $winnersRule->winnersJudgeRun($playersPoint));

    $BlackJackWinnersBeginnerRule->winnerJudge = [];
    $playersPoint = [21, 21, 21, 21];
    $this->assertSame('引き分けです。|引き分けです。|引き分けです。', $winnersRule->winnersJudgeRun($playersPoint));
  }
}
