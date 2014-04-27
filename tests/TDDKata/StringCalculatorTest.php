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

    public function testAddHandlesMultipleCommaSeparatedNumbersString()
    {
        $result = $this->calculator->add("1,2,3");
        $this->assertSame(6, $result);
    }

    public function testAddAllowsNewlineBetweenNumbers()
    {
        $result = $this->calculator->add("1\n2,3");
        $this->assertSame(6, $result);
    }

    public function testAddSupportFirstLineCustomDelimiterDefinition()
    {
        $result = $this->calculator->add("//;1;2");
        $this->assertSame(3, $result);
    }

    public function testAddThrowsExceptionOnNegativeNumbers()
    {
        $this->setExpectedException(
            'TDDKata\Exception\NegativeNumbersNotAllowedException',
            'Negative numbers are not allowed: -1,-2')
        ;

        $this->calculator->add("1,-1,-2");
    }
}