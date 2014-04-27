<?php

namespace TDDKata;

class StringCalculator
{
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

        $numbers = $this->extractNumbers($string);

        $this->throwExceptionIfAnyNegativeNumber($numbers);

        $numbers = $this->sum($numbers);

        return $numbers;
    }

    private function extractNumbers($string)
    {
        $delimiters = $this->getDelimiters($string);

        $delimitersPattern = $this->getDelimitersPattern($delimiters);

        $numbers = preg_split($delimitersPattern, $string);

        return $numbers;
    }

    private function getDelimitersPattern($delimiters)
    {
        $escapedDelimiters = array_map(function($delimiter){
            return preg_quote($delimiter);
        }, $delimiters);

        $pattern = "/".implode("|", $escapedDelimiters)."/";

        return $pattern;
    }

    private function extractCustomDelimiter($string)
    {
        if(preg_match("/^\/\/(?<delimiter>[^\n])/", $string, $matches))
        {
            $customDelimiter = $matches["delimiter"];

            return $customDelimiter;
        }

        return null;
    }

    private function getDelimiters($string)
    {
        $delimiters = [",", "\n"];

        if($customDelimiter = $this->extractCustomDelimiter($string))
        {
            $delimiters      = array_merge([$customDelimiter], $delimiters);
        }

        return $delimiters;
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