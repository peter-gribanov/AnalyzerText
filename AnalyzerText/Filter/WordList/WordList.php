<?php
/**
 * AnalyzerText package
 * 
 * @package AnalyzerText
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */

namespace AnalyzerText\Filter\WordList;

use AnalyzerText\Filter\Filter;
use AnalyzerText\Text;
use AnalyzerText\Text\Word;

/**
 * Оставляет в списке слова из списка или удаляет их
 *
 * Проходи по списку слов и проверяет, что они находится в списке слов которые нужно оставить
 *
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 * @package AnalyzerText\Filter\WordList
 */
abstract class WordList extends Filter {

    /**
     * Простые слова
     *
     * @var array
     */
    private $simple = array();

    /**
     * Составные слова
     *
     * Составные слова о части которого нам известно.
     * Например слово пишется через тирэ
     *
     * @var array
     */
    private $composite = array();

    /**
     * Последовательности из набора слов
     *
     * @var array
     */
    private $sequence = array();


    /**
     * Конструктор
     *
     * @param \AnalyzerText\Text $iterator Текст
     */
    public function __construct(Text $iterator) {
        parent::__construct($iterator);
        $this->repackWordList();
    }

    /**
     * Проверяет, является ли текущее слово допустимым
     *
     * @return boolean
     */
    public function accept() {
        $word = $this->current();
        return $this->isSequence($word) || $this->isSimple($word) || $this->isComposite($word);
    }

    /**
     * Это последовательность
     *
     * @param \AnalyzerText\Text\Word $word Слово
     *
     * @return boolean
     */
    public function isSequence(Word $word) {
        $plain = $word->getPlain();
        foreach ($this->sequence as $sequence) {
            if ($sequence[0] == $plain) {
                for ($i = 1; $i < count($sequence); $i++) {
                    if (!($word = $this->getNextWord($i)) || $word->getPlain() != $sequence[$i]) {
                        return false;
                    }
                }
                // удаляем слова из последовательности
                $key = $this->getText()->key();
                for ($i = 1; $i < count($sequence); $i++) {
                    $this->getText()->seek($key+$i);
                    $this->getText()->remove();
                }
                $this->getText()->seek($key);
                return true;
            }
        }
        return false;
    }

    /**
     * Это простое слово
     *
     * @param \AnalyzerText\Text\Word $word Слово
     *
     * @return boolean
     */
    public function isSimple(Word $word) {
        return in_array($word->getPlain(), $this->simple);
    }

    /**
     * Это составное слово
     *
     * @param \AnalyzerText\Text\Word $word Слово
     *
     * @return boolean
     */
    public function isComposite(Word $word) {
        foreach ($this->composite as $reg) {
            if (preg_match($reg, $word->getWord())) {
                return true;
            }
        }
        return false;
    }

    /**
     * Возвращает список слов
     *
     * Возвращает список слов которые необходимо удалить или оставить
     * Если слово составное и пишестся через тире, но одна из частей может менятся например:
     * <code>
     *   подай-ка, налей-ка, молоко-то сбежало, наценка-с
     * </code>
     * то нужно писать шаблон вида:
     * <code>
     *   [ '*-ка', '*-то', '*-с' ]
     * </code>
     * Для удаления последовательности слов ячейка слова должна представляться в виде набора слов разделенных пробелом
     * <code>
     *   [ 'вовсе не', 'несмотря на то что' ]
     * </code>
     * Так же есть возможность указывать регулярные выражения для отлавливания сложных конструкций
     * <code>
     *   // ААааа Аааа-а-а
     *   [ '/^а+(\-а+)*$/ui' ]
     * </code>
     * В регулярное выражение передается оригинальное слово, а не урощенная форма
     *
     * @return array
     */
    abstract public function getWords();

    /**
     * Разбор набора шаблонов слов и составление условий поиска соответствий
     */
    private function repackWordList() {
        $words = $this->getWords();
        // разбор на категории
        foreach ($words as $word) {
            if ($word[0] == '/') { // регулярное выражение
                $this->composite[] = $word;

            } elseif (strpos($word, ' ') !== false) { // последовательность
                $this->sequence[] = explode(' ', $word);

            } elseif (strpos($word, '*') !== false) { // псевдо регулярка
                // из записи *-то делаем регулярное выражение вида: /^.+?\-то$/ui
                $this->composite[] = '/^'.str_replace('\*', '.+?', preg_quote($word, '/')).'$/ui';

            } else { // простое слово
                $this->simple[] = $word;
            }
        }
    }

}