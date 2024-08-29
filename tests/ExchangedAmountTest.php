<?php

require_once __DIR__ . '/../src/ExchangedAmount.php';

use MyLib\ExchangedAmount;
use PHPUnit\Framework\TestCase;

class ExchangedAmountTest extends TestCase
{
    private $exchangedAmount;

     protected function setUp(): void {
         $this->exchangedAmount = new ExchangedAmount("USD", "UAH", 100);
     }

     protected function tearDown(): void {
         $this->exchangedAmount = null;
     }

     public function testExchangedAmount() {
         $result = $this->exchangedAmount->toDecimal();
         $this->assertEquals(4130.08, $result);
     }

}
