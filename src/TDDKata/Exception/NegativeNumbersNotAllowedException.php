<?php

namespace TDDKata\Exception;

class NegativeNumbersNotAllowedException extends \Exception
{
    public function __construct($negative_numbers)
    {
        $this->message = "Negative numbers are not allowed: ".implode(",", $negative_numbers);
    }
}