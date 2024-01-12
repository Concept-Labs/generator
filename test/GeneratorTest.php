<?php
declare(strict_types=1);

namespace Cl\Generator\Test;

use PHPUnit\Framework\TestCase;
use Cl\Generator\Generator;

/**
 * @covers Cl\Generator\Generator
 */
class GeneratorTest extends TestCase
{
    public function testYieldWithValue()
    {
        $value = 'test';
        $generator = Generator::yield($value);

        $this->assertInstanceOf(\Generator::class, $generator);

        $result = iterator_to_array($generator);
        $this->assertEquals([$value], $result);
    }

    public function testYieldWithGenerator()
    {
        $innerGenerator = (function () {
            yield 'inner';
            yield 'inner second';
        })();

        $generator = Generator::yield($innerGenerator);

        $this->assertInstanceOf(\Generator::class, $generator);

        $result = iterator_to_array($generator);
        $this->assertEquals(['inner', 'inner second'], $result);
    }
}