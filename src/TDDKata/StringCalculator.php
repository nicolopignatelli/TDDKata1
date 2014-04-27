<?php

namespace TDDKata;

class StringCalculator
{
    private $extractor;

    public function __construct()
    {
        $this->extractor = new NumberExtractor();
    }

    public function add($string)
    {
        if(empty($string))
        {
            return 0;
        }

        if(preg_match("/^\d+$/", $string))
        {
            return intval($string);
        }

        $numbers = $this->extractor->extract($string);

        $this->throwExceptionIfAnyNegativeNumber($numbers);

        $numbers = $this->sum($numbers);

        return $numbers;
    }

    private function throwExceptionIfAnyNegativeNumber($numbers)
    {
        $negativeNumbers = [];

        foreach ($numbers as $number) {
            if ($number < 0) {
                $negativeNumbers[] = $number;
            }
        }

        if (count($negativeNumbers) > 0) {
            throw new Exception\NegativeNumbersNotAllowedException($negativeNumbers);
        }
    }

    private function sum($numbers)
    {
        $sum = 0;

        foreach ($numbers as $number) {
            if ($this->numberIsLessThanOrEqualToOneThousand($number)) {
                $sum += $number;
            }
        }

        return $sum;
    }

    private function numberIsLessThanOrEqualToOneThousand($number)
    {
        return $number <= 1000;
    }
}