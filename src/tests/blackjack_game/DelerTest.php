<?php

namespace blackJack\Tests;

use PHPUnit\Framework\TestCase;
use blackJack\DrawCard as DrawCard;
use blackJack\Deler as Deler;

require_once(__DIR__ . '/../../lib/blackjack/DrawCard.php');
require_once(__DIR__ . '/../../lib/blackjack/Deler.php');
require_once(__DIR__ . '/../../lib/blackjack/players.php');
require_once(__DIR__ . '/../../lib/blackjack/PlayersRun.php');


class DelerTest extends TestCase
{
  public function testPlayersDraw()
  {
    $drawCard = new DrawCard();
    $drawCard->deckCreate();
    $deler = new Deler($drawCard);
    //引いたカードの配列の数を返す（ドローカードはランダム値を返す）
    $this->assertSame(2, count($deler->playersDraw())); //[suit, card]
  }

  public function testPlayersPoint()
  {
    $drawCard = new DrawCard();
    $drawCard->cardDeck = ['HA'];
    $deler = new Deler($drawCard);
    $deler->playersDraw();
    //ポイント11の場合 Aは1になる
    $deler->point = 11;
    $this->assertSame(12, $deler->playersPoint());

    //ポイント10の場合 Aは11になる
    $deler->point = 10;
    $this->assertSame(21, $deler->playersPoint());
  }
}
