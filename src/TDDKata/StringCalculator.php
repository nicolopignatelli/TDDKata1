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
        $sum     = array_sum($numbers);

        return $sum;
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
}