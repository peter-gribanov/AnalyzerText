<?php
/**
 * AnalyzerText package.
 *
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */

namespace AnalyzerText\Filter;

use AnalyzerText\Text;
use AnalyzerText\Text\Word;

/**
 * Фильтр итератор
 *
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
abstract class Filter extends \FilterIterator
{
    /**
     * @param Text $text
     */
    public function __construct(Text $text)
    {
        parent::__construct($text);
    }

    /**
     * Возвращает текущее слово.
     *
     * @return Word
     */
    public function current()
    {
        return $this->getInnerIterator()->current();
    }

    /**
     * Возвращает текст
     *
     * @return Text
     */
    public function getText()
    {
        return $this->getInnerIterator();
    }

    /**
     * Возвращает текст
     *
     * @return Text
     */
    public function getInnerIterator()
    {
        return parent::getInnerIterator();
    }

    /**
     * Заменяет слово в тексте.
     *
     * @param Word $word Слово
     */
    protected function replace(Word $word)
    {
        $this->getInnerIterator()->replace($word);
    }

    /**
     * Возвращает предыдущее слово.
     *
     * @param int $shift Смещение
     *
     * @return Word|null
     */
    protected function getPreviousWord($shift = 1)
    {
        return $this->getText()->offsetGet($this->getText()->key() + $shift * -1);
    }

    /**
     * Возвращает следующее слово.
     *
     * @param int $shift Смещение
     *
     * @return Word|null
     */
    protected function getNextWord($shift = 1)
    {
        return $this->getText()->offsetGet($this->getText()->key() + $shift);
    }
}
