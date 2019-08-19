<?php

namespace AnalyzerText\Tests\Text;

use AnalyzerText\Text\Word;

class WordTest extends \PHPUnit_Framework_TestCase
{
    public function test()
    {
        $word = new Word('foo', 'bar');

        $this->assertEquals('foo', $word->getWord());
        $this->assertEquals('bar', $word->getPlain());
        $this->assertEquals('foo', (string) $word);
    }
}
