<?php

namespace blackJack\Tests;

use PHPUnit\Framework\TestCase;
use blackJack\ScoreConversion as ScoreConversion;

require_once(__DIR__ . '/../../lib/blackjack/DrawCard.php');
require_once(__DIR__ . '/../../lib/blackjack/ScoreConversion.php');
require_once(__DIR__ . '/../../lib/blackjack/ScoreConversionRun.php');
require_once(__DIR__ . '/../../lib/blackjack/ScoreConversionSet.php');

class ScoreConversionTest extends TestCase
{
  public function testScoreConversion()
  {
    //現在のポイントが11の時
    $scoreConversion = new ScoreConversion(11);
    $drawCard = ['H', '2'];
    $this->assertSame(2, $scoreConversion->scoreConversion($drawCard));

    $drawCard = ['H', '9'];
    $this->assertSame(9, $scoreConversion->scoreConversion($drawCard));

    $drawCard = ['H', 'J'];
    $this->assertSame(10, $scoreConversion->scoreConversion($drawCard));

    $drawCard = ['H', 'A'];
    $this->assertSame(1, $scoreConversion->scoreConversion($drawCard));

    //現在のポイントが10の時
    $scoreConversion = new ScoreConversion(10);
    $drawCard = ['H', 'A'];
    $this->assertSame(11, $scoreConversion->scoreConversion($drawCard));
  }
}
