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

        list($num1, $num2) = explode(",", $string);
        $sum     = $num1 + $num2;

        return $sum;
    }
}