<?php
/**
 * AnalyzerText package.
 *
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */

namespace AnalyzerText;

use AnalyzerText\Text\Word;

/**
 * Анализируемый текст
 *
 * Класс используется для абстрагирования мотодов доступа к словами в тексте, предоставляя простой интерфейс
 *
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class Text extends \ArrayIterator
{
    /**
     * Спиок всех слов в тексте в простой форме.
     *
     * @var array
     */
    protected $plains = array();

    /**
     * @param string $text
     */
    public function __construct($text)
    {
        $words = array();
        // слово не может начинаться с тире и не может содержать только его
        if (preg_match_all('/[[:alnum:]]+(?:[-\'][[:alnum:]]+)*/u', trim(strip_tags($text)), $match)) {
            $words = $match[0];
            // получение списка слов в нижнем регистре
            $this->plains = explode(' ', mb_strtolower(implode(' ', $words), 'utf8'));
        }
        parent::__construct($words);
    }

    /**
     * Возвращает список слов.
     *
     * @return array
     */
    public function getWords()
    {
        return $this->getArrayCopy();
    }

    /**
     * Возвращает текущий элемент
     *
     * @return Word
     */
    public function current()
    {
        return new Word(parent::current(), $this->plains[$this->key()]);
    }

    /**
     * Удаляет слово из текста.
     */
    public function remove()
    {
        $this->offsetUnset($this->key());
        unset($this->plains[$this->key()]);
    }

    /**
     * Заменяет слово в тексте.
     *
     * @param Word $word
     */
    public function replace(Word $word)
    {
        $this->offsetSet($this->key(), $word->getWord());
        $this->plains[$this->key()] = $word->getPlain();
    }

    /**
     * Возвращает текст
     *
     * @return string
     */
    public function __toString()
    {
        return implode(' ', $this->getWords());
    }
}
