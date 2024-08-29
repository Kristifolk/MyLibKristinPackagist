<?php

require_once __DIR__ . '/vendor/autoload.php';

use MyLib\ExchangedAmount;

$amount = new ExchangedAmount("USD", "UAH", 100);
// Вернет около 2727,12
// Вернет около 4130.08 29.08.24
var_dump($amount->toDecimal());
