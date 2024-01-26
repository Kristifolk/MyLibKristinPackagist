<?php

namespace MyLib;

class ExchangedAmount
{
    /*
     конструктор до версии php 8.0
    private string $from;
    private string $to;
    private int $amount;

    public function __construct($from, $to, $amount)
    {
        $this->from = $from;
        $this->to = $to;
        $this->amount = $amount;
    }
    */

    //конструктор в версии php 8
    public function __construct(
        private readonly string $from,
        private readonly string $to,
        private readonly int $amount
    ) {
    }

    private function dataAPI(): \SimpleXMLElement
    {
        $date = date('d/m/Y'); // Текущая дата
        $url = 'https://www.cbr.ru/scripts/XML_daily.asp?date_req=' . $date;  // котировки на текущий день ЦБР

        $xml = simpleXML_load_file($url, "SimpleXMLElement", LIBXML_NOCDATA);

        if (!$xml) {
            var_dump("Ошибка подключения!");
            die();
        }

        return $xml;

        //simplexml_load_file — Интерпретирует XML-файл в объект. принимает три параметра: URL-адрес файла, тип объекта,
        // который будет создан из XML-данных (в данном случае SimpleXMLElement), и флаг LIBXML_NOCDATA,
        // который указывает, что CDATA-секции в XML-файле не должны быть преобразованы в объекты.
    }

    private function value(string $currencyLetterCode): float
    {
        foreach ($this->dataAPI() as $element) {
            $charCode = $element->CharCode;
            if ($currencyLetterCode == $charCode) {
                // Заменяем запятую на точку
                return floatval(str_replace(',', '.', $element->Value));
            }
        }
        return 0;
    }

    private function nominal(string $currencyLetterCode): float
    {
        foreach ($this->dataAPI() as $element) {
            $charCode = $element->CharCode;
            if ($currencyLetterCode == $charCode) {
                return floatval($element->Nominal);
            }
        }
        return 0;
    }

    public function toDecimal(): float
    {
        $valueFrom = $this->value($this->from);
        $nominalFrom = $this->nominal($this->from);
        $valueTo = $this->value($this->to);
        $nominalTo = $this->nominal($this->to);
        return round($this->amount * (($valueFrom / $nominalFrom) / ($valueTo / $nominalTo)), 2);
    }
}


//получить числовое значение из объекта SimpleXMLElement, вы можете использовать функцию floatval()
//private function dataAPI(): \SimpleXMLElement тип данных указали \SimpleXMLElement вместо SimpleXMLElement, чтобы указать полное пространство имен для класса SimpleXMLElement