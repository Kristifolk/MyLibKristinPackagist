<?php

require_once __DIR__ . '/vendor/autoload.php';

//use PrivatCoolLib\ExchangedAmount;
use MyLib\ExchangedAmount;

$amount = new ExchangedAmount("USD", "UAH", 100);
// Вернет около 2727,12
var_dump($amount->toDecimal());