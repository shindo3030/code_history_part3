<?php

namespace poker\Tests;

use PHPUnit\Framework\TestCase;
use poker\PokerCard as PokerCard;
use poker\CardThreePokerRule as CardThreePokerRule;

require_once(__DIR__ . '/../../lib/poker/CardThreePokerRule.php');
class CardThreePokerRuleTest extends TestCase
{
  public function testRankToRoleConvert()
  {
    $rule = new CardThreePokerRule();
    $this->assertSame([
      'name' => 'three card',
      'rank' => 4,
      'primary' => 1,
      'secondary' => 1,
      'thrd' => 1,
    ], $rule->rankToRoleConvert([new PokerCard('C2'), new PokerCard('D2'), new PokerCard('S2')]));

    $this->assertSame([
      'name' => 'straight',
      'rank' => 3,
      'primary' => 10,
      'secondary' => 9,
      'thrd' => 8,
    ], $rule->rankToRoleConvert([new PokerCard('C10'), new PokerCard('H9'), new PokerCard('DJ')]));
  }
}
