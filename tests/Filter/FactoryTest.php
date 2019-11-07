<?php

namespace AnalyzerText\Tests\Filter;

use AnalyzerText\Analyzer\Analyzer;
use AnalyzerText\Analyzer\Frequency;
use AnalyzerText\Filter\Factory;
use AnalyzerText\Text;
use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{
    /**
     * @var Factory
     */
    private $factory;

    /**
     * @var Analyzer
     */
    private $analyzer;

    protected function setUp()
    {
        $this->analyzer = new Frequency();
        $this->factory = $this->analyzer->applyFilters();
    }

    protected function tearDown()
    {
        $this->analyzer->clear();
    }

    public function testUnion()
    {
        $this->analyzer->setText(new Text('Так словно НиКак'));
        $this->factory->Union();

        $this->assertEquals('Так словно', (string) $this->analyzer->getText());
    }

    public function testPronoun()
    {
        $this->analyzer->setText(new Text('Я говорю о сЕбе'));
        $this->factory->Pronoun();

        $this->assertEquals('Я сЕбе', (string) $this->analyzer->getText());
    }

    public function testPreposition()
    {
        $this->analyzer->setText(new Text('Я буду Через час'));
        $this->factory->Preposition();

        $this->assertEquals('Через', (string) $this->analyzer->getText());
    }

    public function testAdverb()
    {
        $this->analyzer->setText(new Text('аКкуратно распилить'));
        $this->factory->Adverb();

        $this->assertEquals('аКкуратно', (string) $this->analyzer->getText());
    }

    /**
     * @return array
     */
    public function getInformativeText()
    {
        return array(
            array('Так словно НиКак', ''),
            array('Я говорю о сЕбе', 'говорю'),
            array('Я буду Через час или два', 'буду час два'),
            array('аКкуратно распИлить', 'распИлить'),
            array('Аааа-а-а сказал Василичь', 'сказал Василичь'),
            array('со всей силы', ''),
            array('Петрович ударил со всей силы кулаком по столу', 'Петрович ударил кулаком столу'),
            array(
                'Шел дождь и в то же время снег. И тот и другой были крайне неприятными',
                'Шел дождь снег были неприятными',
            ),
        );
    }

    /**
     * @dataProvider getInformativeText
     *
     * @param string $text
     * @param string $expected
     */
    public function testInformative($text, $expected)
    {
        $this->analyzer->setText(new Text($text));
        $this->factory->Informative();

        $this->assertEquals($expected, (string) $this->analyzer->getText());
    }
}
