<?php

namespace blackJack\Tests;

use PHPUnit\Framework\TestCase;
use blackJack\Player3 as Player3;
use blackJack\DrawCard as DrawCard;

require_once(__DIR__ . '/../../lib/blackjack/DrawCard.php');
require_once(__DIR__ . '/../../lib/blackjack/Player3.php');
require_once(__DIR__ . '/../../lib/blackjack/players.php');
require_once(__DIR__ . '/../../lib/blackjack/PlayersRun.php');

class Player3Test extends TestCase
{
  public function testPlayersDraw()
  {
    $drawCard = new DrawCard();
    $drawCard->deckCreate();
    $player3 = new Player3($drawCard);
    //引いたカードの配列の数を返す（ドローカードはランダム値を返す）
    $this->assertSame(2, count($player3->playersDraw())); //[suit, card]
  }

  public function testPlayersPoint()
  {

    $drawCard = new DrawCard();
    $drawCard->cardDeck = ['HA'];
    $player3 = new Player3($drawCard);
    $player3->playersDraw();
    $player3->point = 11;
    //ポイント11の場合 Aは1になる
    $this->assertSame(12, $player3->playersPoint());

    $player3->point = 10;
    //ポイント10の場合 Aは11になる
    $this->assertSame(21, $player3->playersPoint());
  }
}
