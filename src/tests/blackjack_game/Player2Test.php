<?php

namespace blackJack\Tests;

use PHPUnit\Framework\TestCase;
use blackJack\Player2 as Player2;
use blackJack\DrawCard as DrawCard;

require_once(__DIR__ . '/../../lib/blackjack/DrawCard.php');
require_once(__DIR__ . '/../../lib/blackjack/Player2.php');
require_once(__DIR__ . '/../../lib/blackjack/players.php');
require_once(__DIR__ . '/../../lib/blackjack/PlayersRun.php');

class Player2Test extends TestCase
{
  public function testPlayersDraw()
  {
    $drawCard = new DrawCard();
    $drawCard->deckCreate();
    $player2 = new Player2($drawCard);
    //引いたカードの配列の数を返す（ドローカードはランダム値を返す）
    $this->assertSame(2, count($player2->playersDraw())); //[suit, card]
  }

  public function testPlayersPoint()
  {

    $drawCard = new DrawCard();
    $drawCard->cardDeck = ['HA'];
    $player2 = new Player2($drawCard);
    $player2->playersDraw();
    $player2->point = 11;
    //ポイント11の場合 Aは1になる
    $this->assertSame(12, $player2->playersPoint());

    $player2->point = 10;
    //ポイント10の場合 Aは11になる
    $this->assertSame(21, $player2->playersPoint());
  }
}
