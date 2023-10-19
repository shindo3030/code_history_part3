<?php

namespace blackJack\Tests;

use PHPUnit\Framework\TestCase;
use blackJack\ScoreConversion as ScoreConversion;
use blackJack\ScoreConversionRun as ScoreConversionRun;

require_once(__DIR__ . '/../../lib/blackjack/DrawCard.php');
require_once(__DIR__ . '/../../lib/blackjack/ScoreConversion.php');
require_once(__DIR__ . '/../../lib/blackjack/ScoreConversionRun.php');
require_once(__DIR__ . '/../../lib/blackjack/ScoreConversionSet.php');

class ScoreConversionRunTest extends TestCase
{
  public function testScoreConversionRuns()
  {

    $scoreConversionRun = new ScoreConversionRun(new ScoreConversion(11));
    $drawCard = ['H', '2'];
    $this->assertSame(2, $scoreConversionRun->scoreConversionRuns($drawCard));

    $drawCard = ['H', '9'];
    $this->assertSame(9, $scoreConversionRun->scoreConversionRuns($drawCard));

    $drawCard = ['H', 'Q'];
    $this->assertSame(10, $scoreConversionRun->scoreConversionRuns($drawCard));

    //現在のポイントが11の時
    $drawCard = ['H', 'A'];
    $this->assertSame(
      1,
      $scoreConversionRun->scoreConversionRuns($drawCard)
    );

    //現在のポイントが10の時
    $scoreConversionRun = new ScoreConversionRun(new ScoreConversion(10));
    $drawCard = ['H', 'A'];
    $this->assertSame(
      11,
      $scoreConversionRun->scoreConversionRuns($drawCard)
    );
  }
}
