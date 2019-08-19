<?php
/**
 * AnalyzerText package
 * 
 * @package AnalyzerText
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */

namespace AnalyzerText\Filter\WordList;

use AnalyzerText\Filter\WordList\WordList;

/**
 * Оставляет в списке союзы
 *
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 * @package AnalyzerText\Filter\WordList
 */
class Union extends WordList {

    /**
     * Возвращает список слов
     *
     * @return array
     */
    public function getWords() {
        return array(
            'как', 'словно', 'так', 'для', 'того', 'чтобы', 'тоже', 'зато', 'потому',
            'что', 'и', 'а', 'или', 'но', 'однако', 'ни', 'если', 'то', 'да', 'не',
            'только', 'или', 'либо', 'ли', 'же', 'все', 'столько', 'также', 'притом',
            'причём', 'причем', 'есть', 'именно', 'когда', 'лишь', 'едва', 'будто',
            'точно', 'бы', 'коли', 'ежели', 'несмотря', 'на', 'хотя', 'хоть', 'пускай',
            'дабы', 'c', 'тем', 'ведь', 'чем', 'в то же время'
        );
    }

}