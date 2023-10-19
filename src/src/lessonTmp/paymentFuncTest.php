<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../lib/paymentFunc.php');

class PaymentFuncTest extends TestCase
{
    public function testDisplayResult()
    {
        $this->assertSame(1298, calc('21:00', [1, 1, 1, 3, 5, 7, 8, 9, 10]));
    }
}
