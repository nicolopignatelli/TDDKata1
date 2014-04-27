<?php

namespace TDDKata;

class NumberExtractor
{
    public function extract($string)
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

    private function extractCustomDelimiters($string)
    {
        if($anyLengthCustomDelimiters = $this->extractAnyLengthCustomDelimiters($string))
        {
            return $anyLengthCustomDelimiters;
        }

        if($singleCharacterCustomDelimiter = $this->extractSingleCharacterCustomDelimiter($string))
        {
            return [$singleCharacterCustomDelimiter];
        }

        return null;
    }

    private function extractSingleCharacterCustomDelimiter($string)
    {
        if(preg_match("/^\/\/(?<delimiter>[^\n])/", $string, $matches))
        {
            $customDelimiter = $matches["delimiter"];

            return $customDelimiter;
        }

        return null;
    }

    private function extractAnyLengthCustomDelimiters($string)
    {
        if(preg_match("/^\/\/(?<delimiters>(\[[^]]+\])+)+\n/", $string, $matches))
        {
            $customDelimiters = explode("][", trim($matches["delimiters"], "[]"));

            return $customDelimiters;
        }

        return null;
    }

    private function getDelimiters($string)
    {
        $delimiters = [",", "\n"];

        if($customDelimiters = $this->extractCustomDelimiters($string))
        {
            $delimiters = array_merge($customDelimiters, $delimiters);
        }

        return $delimiters;
    }
}