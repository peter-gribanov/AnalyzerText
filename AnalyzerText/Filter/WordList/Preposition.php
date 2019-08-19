<?php
/**
 * AnalyzerText package.
 *
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */

namespace AnalyzerText\Filter\WordList;

/**
 * Оставляет в списке предлоги.
 *
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class Preposition extends WordList
{
    /**
     * Возвращает список слов.
     *
     * @return array
     */
    public function getWords()
    {
        return array(
            // русские предлоги
            'без',
            'в',
            'до',
            'для',
            'за',
            'из',
            'к',
            'ко',
            'на',
            'над',
            'о',
            'об',
            'обо',
            'от',
            'по',
            'под',
            'пред',
            'при',
            'про',
            'с',
            'у',
            'через',
            'со',
            'из-за',
            'из-под',
            'около',
            'близ',

            // английские предлоги
            'at',
            'on',
            'in',
            'about',
            'above',
            'below',
            'during',
            'after',
            'before',
            'by',
            'for',
            'from',
            'of',
            'since',
            'to',
            'till',
            'with',
            'up',
            'down',
            'off',
            'onto',
            'towards',
            'away',
            'through',
            'into',
            'along',
            'past',
            'across',
            'over',
            'between',
            'under',
            'outside',
            'the',
            'a',
            'are',
        );
    }
}
