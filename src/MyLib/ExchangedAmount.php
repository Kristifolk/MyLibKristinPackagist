<?php

namespace MyLib;

class ExchangedAmount
{
    private $from;
    private $to;
    private $amount;
    private $xml;

    public function __construct($from, $to, $amount)
    {
        $this->from = $from;
        $this->to = $to;
        $this->amount = $amount;
    }

    private function dataAPI(): \SimpleXMLElement
    {
        $date = date('d/m/Y'); // Текущая дата
        $url = 'https://www.cbr.ru/scripts/XML_daily.asp?date_req=' . $date;//котировки на текущий день ЦБР

        $xml = simpleXML_load_file($url, "SimpleXMLElement", LIBXML_NOCDATA);
        //simplexml_load_file — Интерпретирует XML-файл в объект. принимает три параметра: URL-адрес файла, тип объекта, который будет создан из XML-данных (в данном случае SimpleXMLElement), и флаг LIBXML_NOCDATA, который указывает, что CDATA-секции в XML-файле не должны быть преобразованы в объекты.
        return $xml;
    }

    private function value($currencyLetterCode): float
    {
        foreach ($this->xml as $element) {
            $charCode = $element->CharCode;
            if ($currencyLetterCode == $charCode) {
                $value = floatval(str_replace(',', '.', $element->Value)); // Заменяем запятую на точку
                return $value;
            }
        }
        return 0;
    }

    private function nominal($currencyLetterCode): float
    {
        foreach ($this->xml as $element) {
            $charCode = $element->CharCode;
            if ($currencyLetterCode == $charCode) {
                $nominal = floatval($element->Nominal);
                return $nominal;
            }
        }
        return 0;
    }

    public function toDecimal(): float
    {
        $this->xml = $this->dataAPI();
        $valueFrom = $this->value($this->from);
        $nominalFrom = $this->nominal($this->from);
        $valueTo = $this->value($this->to);
        $nominalTo = $this->nominal($this->to);
        $amountTo = round($this->amount * (($valueFrom / $nominalFrom) / ($valueTo / $nominalTo)), 2);
        //print_r($amountTo);
        return $amountTo;
    }
}


//получить числовое значение из объекта SimpleXMLElement, вы можете использовать функцию floatval()
//private function dataAPI(): \SimpleXMLElement тип данных указали \SimpleXMLElement вместо SimpleXMLElement, чтобы указать полное пространство имен для класса SimpleXMLElement