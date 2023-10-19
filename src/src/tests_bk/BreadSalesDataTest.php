<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../lib/BreadSalesData.php');

class BreadSalesDataTest extends TestCase
{
  public function testDisplayResult()
  {
    $output = <<<EOD
    2464
    1
    5 10

    EOD;
    $this->expectOutputString($output);

    $salesData = chunkInputs(['file', '1', '10', '2', '3', '5', '1', '7', '5', '10', '1']);
    $maxValues = maxData($salesData);
    $minValues = minData($salesData);
    $total = totalData($salesData);
    displayResult([$total], $maxValues, $minValues);
  }
}
