<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../lib/noNamefunction.php');

class noNamefunctionTest extends TestCase
{
  public function testCardsResult()
  {
    $this->assertSame(['7'], convertToNumber('C7'));
    $this->assertSame(['3', '10', 'A'], convertToNumber('H3', 'S10', 'DA'));
  }
}

//C7 =>['7']
//H3 S10 DA =>['3','10','A']
