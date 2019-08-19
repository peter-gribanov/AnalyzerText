<?php
/**
 * AnalyzerText package
 * 
 * @package AnalyzerText
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */

namespace AnalyzerText\Filter;

use AnalyzerText\Analyzer\Analyzer;
use AnalyzerText\Filter\Informative;
use AnalyzerText\Filter\WordList\Adverb;
use AnalyzerText\Filter\WordList\Interjection;
use AnalyzerText\Filter\WordList\Particle;
use AnalyzerText\Filter\WordList\Preposition;
use AnalyzerText\Filter\WordList\Pronoun;
use AnalyzerText\Filter\WordList\Union;
use AnalyzerText\Filter\Filter;
use AnalyzerText\Text;

/**
 * Фабрика фильтров
 *
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 * @package AnalyzerText\Filter
 */
class Factory {

    /**
     * Анализатор
     *
     * @var \AnalyzerText\Analyzer\Analyzer
     */
    private $analyzer;


    /**
     * Конструктор
     *
     * @param \AnalyzerText\Analyzer\Analyzer $analyzer Анализатор
     */
    public function __construct(Analyzer $analyzer) {
        $this->analyzer = $analyzer;
    }

    /**
     * Применяет фильтр Informative
     *
     * @return \AnalyzerText\Filter\Factory
     */
    public function Informative() {
        return $this->apply(new Informative($this->analyzer->getText()));
    }

    /**
     * Применяет фильтр Preposition
     *
     * @return \AnalyzerText\Filter\Factory
     */
    public function Preposition() {
        return $this->apply(new Preposition($this->analyzer->getText()));
    }

    /**
     * Применяет фильтр Pronoun
     *
     * @return \AnalyzerText\Filter\Factory
     */
    public function Pronoun() {
        return $this->apply(new Pronoun($this->analyzer->getText()));
    }

    /**
     * Применяет фильтр Union
     *
     * @return \AnalyzerText\Filter\Factory
     */
    public function Union() {
        return $this->apply(new Union($this->analyzer->getText()));
    }

    /**
     * Применяет фильтр Adverb
     *
     * @return \AnalyzerText\Filter\Factory
     */
    public function Adverb() {
        return $this->apply(new Adverb($this->analyzer->getText()));
    }

    /**
     * Применяет фильтр
     *
     * @param \AnalyzerText\Filter\Filter $filter Фильтр
     *
     * @return \AnalyzerText\Filter\Factory
     */
    private function apply(Filter $filter) {
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
