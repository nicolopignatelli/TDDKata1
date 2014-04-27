<?php

namespace TDDKata\Tests;

use TDDKata\StringCalculator;

class StringCalculatorTest extends \PHPUnit_Framework_TestCase
{
    private $calculator;

    public function setup()
    {
        $this->calculator = new StringCalculator();
    }

    public function testAddEmptyStringReturnsZero()
    {
        $result = $this->calculator->add("");
        $this->assertSame(0, $result);
    }

    public function testAddHandlesSingleNumberString()
    {
        $result = $this->calculator->add("2");
        $this->assertSame(2, $result);
    }

    public function testAddHandlesTwoCommaSeparatedNumbersString()
    {
        $result = $this->calculator->add("1,2");
        $this->assertSame(3, $result);
    }
}