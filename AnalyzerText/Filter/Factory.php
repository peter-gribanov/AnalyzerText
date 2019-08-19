<?php
/**
 * AnalyzerText package.
 *
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */

namespace AnalyzerText\Filter;

use AnalyzerText\Analyzer\Analyzer;
use AnalyzerText\Filter\WordList\Adverb;
use AnalyzerText\Filter\WordList\Preposition;
use AnalyzerText\Filter\WordList\Pronoun;
use AnalyzerText\Filter\WordList\Union;

/**
 * Фабрика фильтров.
 *
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class Factory
{
    /**
     * @var Analyzer
     */
    private $analyzer;

    /**
     * @param Analyzer $analyzer
     */
    public function __construct(Analyzer $analyzer)
    {
        $this->analyzer = $analyzer;
    }

    /**
     * Применяет фильтр Informative.
     *
     * @return Factory
     */
    public function Informative()
    {
        return $this->apply(new Informative($this->analyzer->getText()));
    }

    /**
     * Применяет фильтр Preposition.
     *
     * @return Factory
     */
    public function Preposition()
    {
        return $this->apply(new Preposition($this->analyzer->getText()));
    }

    /**
     * Применяет фильтр Pronoun.
     *
     * @return Factory
     */
    public function Pronoun()
    {
        return $this->apply(new Pronoun($this->analyzer->getText()));
    }

    /**
     * Применяет фильтр Union.
     *
     * @return Factory
     */
    public function Union()
    {
        return $this->apply(new Union($this->analyzer->getText()));
    }

    /**
     * Применяет фильтр Adverb.
     *
     * @return Factory
     */
    public function Adverb()
    {
        return $this->apply(new Adverb($this->analyzer->getText()));
    }

    /**
     * Применяет фильтр
     *
     * @param Filter $filter
     *
     * @return Factory
     */
    private function apply(Filter $filter)
    {
        if ($filter->getText()->count()) {
            $words = array();
            foreach ($filter as $word) {
                $words[] = $word->getWord();
            }
            $text_class = get_class($filter->getText());
            $this->analyzer->setText(new $text_class(implode(' ', $words)));
        }

        return $this;
    }
}
