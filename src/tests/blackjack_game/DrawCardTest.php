<?php

namespace blackJack\Tests;

use PHPUnit\Framework\TestCase;
use blackJack\DrawCard as DrawCard;

require_once(__DIR__ . '/../../lib/blackjack/DrawCard.php');

class DrawCardTest extends TestCase
{
  public function testDeckCreate()
  {
    $draw = new DrawCard();
    //デッキクリエイトを実行し、カードの配列総数が52枚になれば正
    $this->assertSame(52, count($draw->deckCreate()));
  }

  public function testDrawCard()
  {
    $draw = new DrawCard();
    $draw->deckCreate();
    //ドローカードを実行し、ドローしたカードの配列総数が2枚(suit,Num)になれば正
    $this->assertSame(2, count($draw->drawCard()));
  }
}
