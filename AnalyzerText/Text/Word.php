<?php
/**
 * AnalyzerText package
 * 
 * @package AnalyzerText
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */

namespace AnalyzerText\Text;

/**
 * Слово в тексте
 *
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 * @package AnalyzerText\Text
 */
class Word {

	/**
	 * Слово в тексте
	 *
	 * @var string
	 */
	protected $word = '';

	/**
	 * Простая форма слова в тексте
	 *
	 * @var string
	 */
	protected $plain = '';


	/**
	 * Конструктор
	 *
	 * @param string $word       Слово в тексте
	 * @param string $lower_case Простая форма слова в тексте
	 */
	public function __construct($word, $plain) {
		$this->word  = $word;
		$this->plain = $plain;
	}

	/**
	 * Возвращает слово из текста
	 *
	 * @return string
	 */
	public function getWord() {
		return $this->word;
	}

	/**
	 * Возвращает простую форму слова из текста
	 *
	 * @return string
	 */
	public function getPlain() {
		return $this->plain;
	}

	/**
	 * Возвращает слово
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->getWord();
	}

}