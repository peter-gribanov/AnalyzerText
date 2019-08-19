<?php
/**
 * AnalyzerText package.
 *
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */

namespace AnalyzerText\Analyzer;

/**
 * Анализатор частоты появления строк в тексте.
 *
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class Frequency extends Analyzer
{
    /**
     * Список слов с частотой их появления.
     *
     * @var array
     */
    protected $frequencies = [];

    /**
     * Список слов с частотой их появления в процентах.
     *
     * @var array
     */
    protected $percent = [];

    /**
     * Очищает анализатор
     *
     * @return \AnalyzerText\Analyzer\Frequency
     */
    public function clear()
    {
        $this->frequencies = [];
        $this->percent = [];

        return parent::clear();
    }

    /**
     * Определяет частоту появления слов.
     *
     * @return array
     */
    public function getFrequency()
    {
        if (!$this->frequencies && $this->getText()->count()) {
            foreach ($this->getText() as $word) {
                if (!isset($this->frequencies[$word->getPlain()])) {
                    $this->frequencies[$word->getPlain()] = 0;
                }
                ++$this->frequencies[$word->getPlain()];
            }
            arsort($this->frequencies);
        }

        return $this->frequencies;
    }

    /**
     * Получение проуентное отнашение частоты слов из списка частот слов.
     *
     * @return array
     */
    public function getPercent()
    {
        if (!$this->percent && ($frequencies = $this->getFrequency())) {
            $ratio = max($frequencies) / 100;
            foreach ($frequencies as $word => $frequency) {
                $this->percent[$word] = $frequency / $ratio;
            }
        }

        return $this->percent;
    }
}
