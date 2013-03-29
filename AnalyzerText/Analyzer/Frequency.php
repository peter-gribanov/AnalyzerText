<?php
/**
 * AnalyzerText package
 * 
 * @package AnalyzerText
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */

namespace AnalyzerText\Analyzer;

use AnalyzerText\Analyzer\Analyzer;

/**
 * Анализатор частоты появления строк в тексте
 *
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 * @package AnalyzerText\Analyzer
 */
class Frequency extends Analyzer {

	/**
	 * Список слов с частотой их появления
	 *
	 * @var array
	 */
	protected $frequencies = array();

	/**
	 * Список слов с частотой их появления в процентах
	 *
	 * @var array
	 */
	protected $percent = array();


	/**
	 * Очищает анализатор
	 * 
	 * @return \AnalyzerText\Analyzer\Frequency
	 */
	public function clear() {
		$this->frequencies = array();
		$this->percent = array();
		return parent::clear();
	}

	/**
	 * Определяет частоту появления слов
	 *
	 * @return array
	 */
	public function getFrequency() {
		if (!$this->frequencies && $this->getText()->count()) {
			foreach ($this->text as $word) {
				if (!isset($this->frequencies[$word->getPlain()])) {
					$this->frequencies[$word->getPlain()] = 0;
				}
				$this->frequencies[$word->getPlain()]++;
			}
			arsort($this->frequencies);
		}
		return $this->frequencies;
	}

	/**
	 * Получение проуентное отнашение частоты слов из списка частот слов
	 *
	 * @return array
	 */
	public function getPercent() {
		if (!$this->percent && ($frequencies = $this->getFrequency())) {
			$ratio = max($frequencies)/100;
			foreach ($frequencies as $word => $frequency) {
				$this->percent[$word] = $frequency/$ratio;
			}
		}
		return $this->percent;
	}

}