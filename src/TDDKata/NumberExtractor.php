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

    private function extractCustomDelimiter($string)
    {
        if($anyLengthCustomDelimiter = $this->extractAnyLengthCustomDelimiter($string))
        {
            return $anyLengthCustomDelimiter;
        }

        if($singleCharactorCustomDelimiter = $this->extractSingleCharacterCustomDelimiter($string))
        {
            return $singleCharactorCustomDelimiter;
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

    private function extractAnyLengthCustomDelimiter($string)
    {
        if(preg_match("/^\/\/\[(?<delimiter>[^]]+)\]\n/", $string, $matches))
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