<?php

namespace blackJack\Tests;

use PHPUnit\Framework\TestCase;
use blackJack\Player1 as Player1;
use blackJack\DrawCard as DrawCard;

require_once(__DIR__ . '/../../lib/blackjack/DrawCard.php');
require_once(__DIR__ . '/../../lib/blackjack/Player1.php');
require_once(__DIR__ . '/../../lib/blackjack/players.php');
require_once(__DIR__ . '/../../lib/blackjack/PlayersRun.php');

class Player1Test extends TestCase
{
  public function testPlayersDraw()
  {
    $drawCard = new DrawCard();
    $drawCard->deckCreate();
    $player1 = new Player1($drawCard);
    //引いたカードの配列の数を返す（ドローカードはランダム値を返す）
    $this->assertSame(2, count($player1->playersDraw())); //[suit, card]
  }

  public function testPlayersPoint()
  {

    $drawCard = new DrawCard();
    $drawCard->cardDeck = ['HA'];
    $player1 = new Player1($drawCard);
    $player1->playersDraw();
    $player1->point = 11;
    //ポイント11の場合 Aは1になる
    $this->assertSame(12, $player1->playersPoint());

    $player1->point = 10;
    //ポイント10の場合 Aは11になる
    $this->assertSame(21, $player1->playersPoint());
  }
}
