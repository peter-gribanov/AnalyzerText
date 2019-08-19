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
     * Конструктор
     *
     * @param \AnalyzerText\Text $iterator Текст
     */
    public function __construct(Text $iterator)
    {
        parent::__construct($iterator);
    }

    /**
     * Возвращает текущее слово.
     *
     * @return \AnalyzerText\Text\Word
     */
    public function current()
    {
        return $this->getInnerIterator()->current();
    }

    /**
     * Возвращает текст
     *
     * @return \AnalyzerText\Text
     */
    public function getText()
    {
        return $this->getInnerIterator();
    }

    /**
     * Возвращает текст
     *
     * @return \AnalyzerText\Text
     */
    public function getInnerIterator()
    {
        return parent::getInnerIterator();
    }

    /**
     * Заменяет слово в тексте.
     *
     * @param \AnalyzerText\Text\Word $word Слово
     */
    protected function replace(Word $word)
    {
        $this->getInnerIterator()->replace($word);
    }

    /**
     * Возвращает предыдущее слово.
     *
     * @param int|null $shift Смещение
     *
     * @return \AnalyzerText\Text\Word|null
     */
    protected function getPreviousWord($shift = 1)
    {
        return $this->getNextWord($shift * -1);
    }

    /**
     * Возвращает следующее слово.
     *
     * @param int|null $shift Смещение
     *
     * @return \AnalyzerText\Text\Word|null
     */
    protected function getNextWord($shift = 1)
    {
        $position = $this->getText()->key();

        try {
            $this->getText()->seek($position + $shift);
        } catch (\OutOfBoundsException $e) {
            return null;
        }
        $word = $this->getText()->current();
        $this->getText()->seek($position);

        return $word;
    }
}
