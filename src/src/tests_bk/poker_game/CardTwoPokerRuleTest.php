<?php

namespace poker\Tests;

use PHPUnit\Framework\TestCase;
use poker\PokerCard as PokerCard;
use poker\CardTwoPokerRule as CardTwoPokerRule;

require_once(__DIR__ . '/../../lib/poker/CardTwoPokerRule.php');
class CardTwoPokerRuleTest extends TestCase
{
  public function testRankToRoleConvert()
  {

    $rule = new CardTwoPokerRule();
    $this->assertSame([
      'name' => 'pair',
      'rank' => 2,
      'primary' => 13,
      'secondary' => 13,
    ], $rule->rankToRoleConvert([new PokerCard('CA'), new PokerCard('DA')]));

    $this->assertSame([
      'name' => 'straight',
      'rank' => 3,
      'primary' => 9,
      'secondary' => 8,
    ], $rule->rankToRoleConvert([new PokerCard('C9'), new PokerCard('H10')]));
  }
}
