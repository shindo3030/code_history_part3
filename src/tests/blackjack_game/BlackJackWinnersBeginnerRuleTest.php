<?php

namespace blackJack\Tests;

use PHPUnit\Framework\TestCase;
use blackJack\BlackJackWinnersBeginnerRule as BlackJackWinnersBeginnerRule;

require_once(__DIR__ . '/../../lib/blackjack/BlackJackWinnersBeginnerRule.php');
require_once(__DIR__ . '/../../lib/blackjack/BlackJackWinnersJudge.php');
require_once(__DIR__ . '/../../lib/blackjack/BlackJackWinnersRule.php');

class BlackJackWinnersBeginnerRuleTest extends TestCase
{
  public function testWinner()
  {
    $BlackJackWinnersBeginnerRule = new BlackJackWinnersBeginnerRule;
    $BlackJackWinnersBeginnerRule->winnerJudge = [];

    $playerPoints = [21, 17, 17, 18];
    $this->assertSame('ディーラーの勝ちです。|ディーラーの勝ちです。|ディーラーの勝ちです。', $BlackJackWinnersBeginnerRule->Winner($playerPoints));

    $BlackJackWinnersBeginnerRule->winnerJudge = [];
    $playerPoints = [18, 20, 20, 20];
    $this->assertSame('プレイヤー1の勝ちです。|プレイヤー2の勝ちです。|プレイヤー3の勝ちです。', $BlackJackWinnersBeginnerRule->Winner($playerPoints));

    $BlackJackWinnersBeginnerRule->winnerJudge = [];
    //配列が追加になって判定されているので配列一つを取得してできるようにテスコードだけ修正
    $playerPoints = [21, 21, 21, 21];
    $this->assertSame('引き分けです。|引き分けです。|引き分けです。', $BlackJackWinnersBeginnerRule->Winner($playerPoints));
  }
}
