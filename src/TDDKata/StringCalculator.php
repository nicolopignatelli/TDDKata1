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
        $numbers = preg_split("/,|\n/", $string);

        return $numbers;
    }
}