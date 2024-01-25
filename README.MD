Библиотека для работы с курсами валют Приватбанка или Сбербканка  (3-5 дней)
Цели:

Разобраться как работает composer


Информация о апи ПриватБанк
[Информация о апи СберБанк])(https://www.cbr.ru/development/SXML/)

Библиотека должна содержать класс ExchangedAmount($from, $to, $amount)  с единственным публичным методом toDecimal, который возвращает сумму после обмена рассчитанную по курсу покупки(buy).
$from, $to - это название валюты из списка USD, EUR, RUR
$amount - сумма которую собираются обменять.
Библиотека должна быть опубликована на packagist. Каждый в своем проекте может подключить библиотеку при помощи composer
composer require vendor/privatcoollib
И использовать в своем коде

use PrivatCoolLib\ExchangedAmount;

$amount = new ExchangedAmount("USD", "UAH", 100);
// Вернет около 2727,12
var_dump($amount->toDecimal())
