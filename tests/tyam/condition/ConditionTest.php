<?php
namespace tyam\condition\Tests;

use \PHPUnit\Framework\TestCase;
use tyam\condition\Condition;

class ConditionTest extends TestCase
{
    public function testFine() {
        $cd0 = Condition::fine('Hello');
        $this->assertEquals($cd0(), true);
        $this->assertEquals($cd0->isFine(), true);
        $this->assertEquals($cd0->isPoor(), false);
        $this->assertEquals($cd0->get(), 'Hello');
        $this->assertEquals($cd0->describe(), null);
    }

    public function testPoor() {
        $cd0 = Condition::poor('ERR101');
        $this->assertEquals($cd0(), false);
        $this->assertEquals($cd0->isFine(), false);
        $this->assertEquals($cd0->isPoor(), true);
        try {
            $cd0->get();
            $this->fail('An exception MUST be thrown.');
        } catch (\LogicException $e) {
            $this->assertTrue(true);
        }
        $this->assertEquals($cd0->describe(), 'ERR101');
    }
}