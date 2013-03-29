<?php
/**
 * AnalyzerText package
 * 
 * @package AnalyzerText
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */

namespace AnalyzerText\Filter;

use AnalyzerText\Filter\Filter;
use AnalyzerText\Text;
use AnalyzerText\Filter\WordList\Adverb;
use AnalyzerText\Filter\WordList\Interjection;
use AnalyzerText\Filter\WordList\Particle;
use AnalyzerText\Filter\WordList\Preposition;
use AnalyzerText\Filter\WordList\Pronoun;
use AnalyzerText\Filter\WordList\Union;

/**
 * Оставляет только информационные слова
 *
 * Сушествительные, глаголы, прилагательные, имена, фамилии
 *
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 * @package AnalyzerText\Filter
 */
class Informative extends Filter {

	/**
	 * Список фильтров
	 *
	 * @var array
	 */
	private $filters = array();


	/**
	 * Конструктор
	 *
	 * @param \AnalyzerText\Text $iterator Текст
	 */
	public function __construct(Text $iterator) {
		parent::__construct($iterator);
		$this->filters = array(
			new Interjection($this->getInnerIterator()),
			new Particle($this->getInnerIterator()),
			new Preposition($this->getInnerIterator()),
			new Pronoun($this->getInnerIterator()),
			new Union($this->getInnerIterator()),
			new Adverb($this->getInnerIterator()),
		);
	}

	/**
	 * (non-PHPdoc)
	 * @see \FilterIterator::accept()
	 */
	public function accept() {
		$word = $this->current();
		// сначала ищем последовательности
		foreach ($this->filters as $filter) {
			if ($filter->isSequence($word)) {
				return false;
			}
		}
		// ищем простые и сложные формы
		foreach ($this->filters as $filter) {
			if ($filter->isSimple($word) || $filter->isComposite($word)) {
				return false;
			}
		}
		return true;
	}

}