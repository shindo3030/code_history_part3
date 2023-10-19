<?php

namespace blackJack\Tests;

use PHPUnit\Framework\TestCase;
use blackJack\PlayersRun as PlayersRun;
use blackJack\Player1 as Player1;
use blackJack\Player1 as Player2;
use blackJack\Player1 as Player3;
use blackJack\Player1 as Deler;
use blackJack\DrawCard as DrawCard;

require_once(__DIR__ . '/../../lib/blackjack/DrawCard.php');
require_once(__DIR__ . '/../../lib/blackjack/Player1.php');
require_once(__DIR__ . '/../../lib/blackjack/Player2.php');
require_once(__DIR__ . '/../../lib/blackjack/Player3.php');
require_once(__DIR__ . '/../../lib/blackjack/players.php');
require_once(__DIR__ . '/../../lib/blackjack/PlayersRun.php');

class PlayersRunTest extends TestCase
{
  public function testPlayerRun()
  {

    $drawCard = new DrawCard();
    $drawCard->deckCreate();

    //Deler
    $deler = new Deler($drawCard);
    $playerRun = new PlayersRun($deler);
    //引いたカードの配列数を返す（ドローカードは常にランダムな為）
    $this->assertSame(2, count($playerRun->playerRun()));

    //player1
    $player1 = new Player1($drawCard);
    $playerRun = new PlayersRun($player1);
    //引いたカードの配列数を返す（ドローカードは常にランダムな為）
    $this->assertSame(2, count($playerRun->playerRun()));

    //player2
    $player2 = new Player2($drawCard);
    $playerRun = new PlayersRun($player2);
    //引いたカードの配列数を返す（ドローカードは常にランダムな為）
    $this->assertSame(2, count($playerRun->playerRun()));

    //player3
    $player3 = new Player3($drawCard);
    $playerRun = new PlayersRun($player3);
    //引いたカードの配列数を返す（ドローカードは常にランダムな為）
    $this->assertSame(2, count($playerRun->playerRun()));
  }
}
