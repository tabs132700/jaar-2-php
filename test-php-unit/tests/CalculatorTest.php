<?php

use PHPUnit\Framework\TestCase;
use Project_calculator\Classes\Calculator;

require_once __DIR__ . '/../src/Calculator.php';

class CalculatorTest extends TestCase
{
    // ADD tests (3)
    public function testAddTwoPositiveNumbers()
    {
        $calculator = new Calculator();
        $this->assertEquals(8, $calculator->add(5, 3));
    }

    public function testAddWithZero()
    {
        $calculator = new Calculator();
        $this->assertEquals(7, $calculator->add(7, 0));
    }

    public function testAddWithNegative()
    {
        $calculator = new Calculator();
        $this->assertEquals(1, $calculator->add(3, -2));
    }

    // SUBTRACT tests (3)
    public function testSubtractPositiveNumbers()
    {
        $calculator = new Calculator();
        $this->assertEquals(6, $calculator->subtract(10, 4));
    }

    public function testSubtractNegativeResult()
    {
        $calculator = new Calculator();
        $this->assertEquals(-4, $calculator->subtract(3, 7));
    }

    public function testSubtractToZero()
    {
        $calculator = new Calculator();
        $this->assertEquals(0, $calculator->subtract(5, 5));
    }

    // MULTIPLY tests (3)
    public function testMultiplyPositiveNumbers()
    {
        $calculator = new Calculator();
        $this->assertEquals(20, $calculator->multiply(4, 5));
    }

    public function testMultiplyWithZero()
    {
        $calculator = new Calculator();
        $this->assertEquals(0, $calculator->multiply(9, 0));
    }

    public function testMultiplyWithNegative()
    {
        $calculator = new Calculator();
        $this->assertEquals(-12, $calculator->multiply(-3, 4));
    }

    // DIVIDE tests (3)
    public function testDivideNormally()
    {
        $calculator = new Calculator();
        $this->assertEquals(5, $calculator->divide(10, 2));
    }

    public function testDivideToFloat()
    {
        $calculator = new Calculator();
        $this->assertEquals(3.5, $calculator->divide(7, 2));
    }

    public function testDivideByZeroThrowsException()
    {
        $calculator = new Calculator();
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Delen door nul is niet mogelijk!");
        $calculator->divide(10, 0);
    }
}
