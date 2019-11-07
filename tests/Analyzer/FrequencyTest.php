<?php

namespace AnalyzerText\Tests\Analyzer;

use AnalyzerText\Analyzer\Frequency;
use AnalyzerText\Text;
use PHPUnit\Framework\TestCase;

class FrequencyTest extends TestCase
{
    /**
     * @var Frequency
     */
    private $frequency;

    protected function setUp()
    {
        $this->frequency = new Frequency();
    }

    protected function tearDown()
    {
        $this->frequency->clear();
    }

    public function testGetSetText()
    {
        $this->assertNull($this->frequency->getText());

        $text = new Text('foo bar');

        $this->assertEquals($this->frequency, $this->frequency->setText($text));
        $this->assertEquals($text, $this->frequency->getText());
    }

    /**
     * @depends testGetSetText
     */
    public function testClear()
    {
        $this->assertNull($this->frequency->getText());

        $text = new Text('foo bar');
        $this->frequency->setText($text);

        $this->assertEquals($text, $this->frequency->getText());

        $this->frequency->clear();

        $this->assertNull($this->frequency->getText());
    }

    public function testApplyFilters()
    {
        $this->assertInstanceOf('AnalyzerText\Filter\Factory', $this->frequency->applyFilters());
    }

    /**
     * @return array
     */
    public function getFrequency()
    {
        return array(
            array('foo Foo FOO bar Bar baz', array(
                'foo' => 3,
                'bar' => 2,
                'baz' => 1,
            )),
            array('baz FOO bar foo Bar Foo BAZ', array(
                'foo' => 3,
                'bar' => 2,
                'baz' => 2,
            )),
        );
    }

    /**
     * @dataProvider getFrequency
     * @depends testGetSetText
     *
     * @param string $text
     * @param array  $frequency
     */
    public function testGetFrequency($text, $frequency)
    {
        $text = new Text($text);
        $this->frequency->setText($text);

        $this->assertEquals($frequency, $this->frequency->getFrequency());
    }

    /**
     * @return array
     */
    public function getPercent()
    {
        return array(
            array('foo foo Foo FOO bar Bar baz', array(
                'foo' => 100.0,
                'bar' => 50.0,
                'baz' => 25.0,
            )),
            array('baz FOO bar foo Bar Foo BAZ foo', array(
                'foo' => 100.0,
                'bar' => 50.0,
                'baz' => 50.0,
            )),
        );
    }

    /**
     * @dataProvider getPercent
     * @depends testGetSetText
     *
     * @param string $text
     * @param array  $percent
     */
    public function testGetPercent($text, $percent)
    {
        $text = new Text($text);
        $this->frequency->setText($text);

        $this->assertEquals($percent, $this->frequency->getPercent());
    }
}
