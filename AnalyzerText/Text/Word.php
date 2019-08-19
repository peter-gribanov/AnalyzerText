<?php
/**
 * AnalyzerText package.
 *
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */

namespace AnalyzerText\Text;

/**
 * Слово в тексте.
 *
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class Word
{
    /**
     * Слово в тексте.
     *
     * @var string
     */
    protected $word = '';

    /**
     * Простая форма слова в тексте.
     *
     * @var string
     */
    protected $plain = '';

    /**
     * @param string $word  Слово в тексте
     * @param string $plain Простая форма слова в тексте
     */
    public function __construct($word, $plain)
    {
        $this->word = $word;
        $this->plain = $plain;
    }

    /**
     * Возвращает слово из текста.
     *
     * @return string
     */
    public function getWord()
    {
        return $this->word;
    }

    /**
     * Возвращает простую форму слова из текста.
     *
     * @return string
     */
    public function getPlain()
    {
        return $this->plain;
    }

    /**
     * Возвращает слово.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->word;
    }
}
