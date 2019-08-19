<?php
/**
 * AnalyzerText package.
 *
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */

namespace AnalyzerText\Analyzer;

use AnalyzerText\Text;
use AnalyzerText\Filter\Factory;

/**
 * Базовый класс для анализаторов текста.
 *
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
abstract class Analyzer
{
    /**
     * @var Text
     */
    protected $text;

    /**
     * Устанавливает аналезируемый текст
     *
     * @param Text $text
     *
     * @return Analyzer
     */
    public function setText(Text $text)
    {
        $this->clear();
        $this->text = $text;

        return $this;
    }

    /**
     * Возвращает список слов.
     *
     * @return Text
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Очищает анализатор
     *
     * @return Analyzer
     */
    public function clear()
    {
        $this->text = null;

        return $this;
    }

    /**
     * Возвращает фабрику фильтров для применения их.
     *
     * @return Factory
     */
    public function applyFilters()
    {
        return new Factory($this);
    }
}
