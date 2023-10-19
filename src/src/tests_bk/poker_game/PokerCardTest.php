<?php

namespace poker\Tests;

use PHPUnit\Framework\TestCase;
use poker\PokerCard as PokerCard;

require_once(__DIR__ . '/../../lib/poker/PokerCard.php');

class PokerCardTest extends TestCase
{
  function testPokerCard()
  {
    $card1 = new PokerCard('CA');
    $card2 = new PokerCard('H10');
    $this->assertSame(13, $card1->cardRank());
    $this->assertSame(9, $card2->cardRank());
  }
}
