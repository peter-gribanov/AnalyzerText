<?php

namespace AnalyzerText\Tests;

use AnalyzerText\Text;
use AnalyzerText\Text\Word;

class TextTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function getText()
    {
        return array(
            array('foo', array('foo')),
            array('-foo bar', array('foo', 'bar')),
            array('Foo, Bar', array('Foo', 'Bar')),
            array('Привет мир!', array('Привет', 'мир')),
            array('Что-то там и что-то еще.', array('Что-то', 'там', 'и', 'что-то', 'еще')),
            array('12345', array('12345')),
            array('1-2-3-4-5', array('1-2-3-4-5')),
            array('World2', array('World2')),
            array('World-3', array('World-3')),
        );
    }

    /**
     * @dataProvider getText
     *
     * @param string   $text
     * @param string[] $words
     */
    public function testIterate($text, array $words)
    {
        $obj = new Text($text);

        foreach ($obj as $key => $word) {
            $this->assertInstanceOf('AnalyzerText\Text\Word', $word);
            $this->assertInternalType('int', $key);
            $this->assertEquals($words[$key], $word->getWord());
            $this->assertEquals(mb_strtolower($words[$key], 'utf8'), $word->getPlain());
        }

        $this->assertEquals($words, $obj->getWords());
        $this->assertEquals(implode(' ', $words), (string) $obj);
    }

    public function testRemove()
    {
        $text = new Text('foo bar baz');
        $text->next(); // go to "bar"
        $text->remove();

        $this->assertEquals('foo baz', (string) $text);
    }

    public function testReplace()
    {
        $text = new Text('foo bar baz');
        $text->next(); // go to "bar"
        $text->replace(new Word('Tor', 'tor'));

        $this->assertEquals('Tor', $text->current()->getWord());
        $this->assertEquals('tor', $text->current()->getPlain());
        $this->assertEquals('foo Tor baz', (string) $text);
    }
}
