<?php

namespace poker\Tests;

use PHPUnit\Framework\TestCase;
use poker\PokerCard as PokerCard;
use poker\CardFivePokerRule as CardFivePokerRule;



require_once(__DIR__ . '/../../lib/poker/CardFivePokerRule.php');
class CardFivePokerRuleTest extends TestCase
{
  public function testRankToRoleConvert()
  {
    $rule = new CardFivePokerRule();
    $this->assertSame('high card', $rule->rankToRoleConvert([new PokerCard('H5'), new PokerCard('C7'), new PokerCard('D9'), new PokerCard('SJ'), new PokerCard('HK')]));
    $this->assertSame('high card', $rule->rankToRoleConvert([new PokerCard('H4'), new PokerCard('C3'), new PokerCard('D2'), new PokerCard('SA'), new PokerCard('HK')]));
    $this->assertSame('high card', $rule->rankToRoleConvert([new PokerCard('H3'), new PokerCard('C2'), new PokerCard('DA'), new PokerCard('SK'), new PokerCard('HQ')]));
    $this->assertSame('high card', $rule->rankToRoleConvert([new PokerCard('H2'), new PokerCard('CA'), new PokerCard('DK'), new PokerCard('SQ'), new PokerCard('HJ')]));
    $this->assertSame('one pair', $rule->rankToRoleConvert([new PokerCard('H5'), new PokerCard('C5'), new PokerCard('D6'), new PokerCard('S7'), new PokerCard('H8')]));
    $this->assertSame('one pair', $rule->rankToRoleConvert([new PokerCard('H4'), new PokerCard('C5'), new PokerCard('D5'), new PokerCard('S6'), new PokerCard('H7')]));
    $this->assertSame('one pair', $rule->rankToRoleConvert([new PokerCard('H4'), new PokerCard('C5'), new PokerCard('D6'), new PokerCard('S6'), new PokerCard('H7')]));
    $this->assertSame('one pair', $rule->rankToRoleConvert([new PokerCard('H4'), new PokerCard('C5'), new PokerCard('D6'), new PokerCard('S7'), new PokerCard('H7')]));
    $this->assertSame('two pair', $rule->rankToRoleConvert([new PokerCard('H5'), new PokerCard('C5'), new PokerCard('D7'), new PokerCard('S7'), new PokerCard('H8')]));
    $this->assertSame('two pair', $rule->rankToRoleConvert([new PokerCard('H5'), new PokerCard('C5'), new PokerCard('D6'), new PokerCard('S7'), new PokerCard('H7')]));
    $this->assertSame('two pair', $rule->rankToRoleConvert([new PokerCard('H4'), new PokerCard('C5'), new PokerCard('D5'), new PokerCard('S7'), new PokerCard('H7')]));
    $this->assertSame('three of a kind', $rule->rankToRoleConvert([new PokerCard('H8'), new PokerCard('C9'), new PokerCard('D10'), new PokerCard('S10'), new PokerCard('H10')]));
    $this->assertSame('three of a kind', $rule->rankToRoleConvert([new PokerCard('H8'), new PokerCard('C9'), new PokerCard('D9'), new PokerCard('S9'), new PokerCard('H10')]));
    $this->assertSame('three of a kind', $rule->rankToRoleConvert([new PokerCard('H8'), new PokerCard('C9'), new PokerCard('D10'), new PokerCard('S10'), new PokerCard('H10')]));
    $this->assertSame('straight', $rule->rankToRoleConvert([new PokerCard('HA'), new PokerCard('CK'), new PokerCard('DQ'), new PokerCard('SJ'), new PokerCard('H10')]));
    $this->assertSame('straight', $rule->rankToRoleConvert([new PokerCard('H5'), new PokerCard('C4'), new PokerCard('D3'), new PokerCard('S2'), new PokerCard('HA')]));
    $this->assertSame('full house', $rule->rankToRoleConvert([new PokerCard('HJ'), new PokerCard('CJ'), new PokerCard('DJ'), new PokerCard('SA'), new PokerCard('HA')]));
    $this->assertSame('full house', $rule->rankToRoleConvert([new PokerCard('H3'), new PokerCard('C3'), new PokerCard('DJ'), new PokerCard('SJ'), new PokerCard('HJ')]));
    $this->assertSame('four of a kind', $rule->rankToRoleConvert([new PokerCard('HQ'), new PokerCard('CQ'), new PokerCard('DQ'), new PokerCard('SQ'), new PokerCard('HK')]));
    $this->assertSame('four of a kind', $rule->rankToRoleConvert([new PokerCard('HJ'), new PokerCard('CQ'), new PokerCard('DQ'), new PokerCard('SQ'), new PokerCard('HQ')]));
  }
}
