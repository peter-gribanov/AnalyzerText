<?php

namespace AnalyzerText\Tests\Text;

use AnalyzerText\Text\Word;
use PHPUnit\Framework\TestCase;

class WordTest extends TestCase
{
    public function test()
    {
        $word = new Word('foo', 'bar');

        $this->assertEquals('foo', $word->getWord());
        $this->assertEquals('bar', $word->getPlain());
        $this->assertEquals('foo', (string) $word);
    }
}
