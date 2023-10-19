<?php

namespace poker\Tests;

use PHPUnit\Framework\TestCase;
use poker\RoleJudge as RoleJudge;
use poker\CardTwoPokerRule as CardTwoPokerRule;
use poker\CardThreePokerRule as CardThreePokerRule;
use poker\CardFivePokerRule as CardFivePokerRule;
use poker\PokerCard as PokerCard;

require_once(__DIR__ . '/../../lib/poker/RoleJudge.php');
require_once(__DIR__ . '/../../lib/poker/PokerCard.php');

class RoleJudgeTest extends TestCase
{

  public function testRankToRoleConvert()
  {
    //カード2枚
    $rankToRoleConvert = new RoleJudge(new CardTwoPokerRule());
    $this->assertSame([
      'name' => 'pair',
      'rank' => 2,
      'primary' => 13,
      'secondary' => 13,
    ], $rankToRoleConvert->rankToRoleConvert([new PokerCard('CA'), new PokerCard('DA')]));
    $this->assertSame([
      'name' => 'straight',
      'rank' => 3,
      'primary' => 9,
      'secondary' => 8,
    ], $rankToRoleConvert->rankToRoleConvert([new PokerCard('C9'), new PokerCard('H10')]));

    //カード３枚
    $rankToRoleConvert = new RoleJudge(new CardThreePokerRule());
    $this->assertSame([
      'name' => 'pair',
      'rank' => 2,
      'primary' => 13,
      'secondary' => 13,
      'thrd' => 9
    ], $rankToRoleConvert->rankToRoleConvert([new PokerCard('CA'), new PokerCard('DA'), new PokerCard('H10')]));
    $this->assertSame([
      'name' => 'straight',
      'rank' => 3,
      'primary' => 2,
      'secondary' => 1,
      'thrd' => 13
    ], $rankToRoleConvert->rankToRoleConvert([new PokerCard('DA'), new PokerCard('S2'), new PokerCard('C3')]));


    //カード5枚
    #役の返しがまだ勝敗判定を付けていないのでreturnがstringの為エラーが出ている、後で判定ロジックに変更する。
    // $rankToRoleConvert = new RoleJudge(new CardFivePokerRule());
    // $this->assertSame('straight', $rankToRoleConvert->rankToRoleConvert([new PokerCard('HA'), new PokerCard('CK'), new PokerCard('DQ'), new PokerCard('SJ'), new PokerCard('H10')]));
    // $this->assertSame('four of a kind', $rankToRoleConvert->rankToRoleConvert([new PokerCard('HJ'), new PokerCard('CQ'), new PokerCard('DQ'), new PokerCard('SQ'), new PokerCard('HQ')]));
  }
}




//     '2' => 1,
//     '3' => 2,
//     '4' => 3,
//     '5' => 4,
//     '6' => 5,
//     '7' => 6,
//     '8' => 7,
//     '9' => 8,
//     '10' => 9,
//     'J' => 10,
//     'Q' => 11,
//     'K' => 12,
//     'A' => 13,
