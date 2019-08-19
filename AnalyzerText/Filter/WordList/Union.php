<?php
/**
 * AnalyzerText package.
 *
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */

namespace AnalyzerText\Filter\WordList;

/**
 * Оставляет в списке союзы.
 *
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class Union extends WordList
{
    /**
     * Возвращает список слов.
     *
     * @return array
     */
    public function getWords()
    {
        return [
            'как', 'словно', 'так', 'для', 'того', 'чтобы', 'тоже', 'зато', 'потому',
            'что', 'и', 'а', 'или', 'но', 'однако', 'ни', 'если', 'то', 'да', 'не',
            'только', 'или', 'либо', 'ли', 'же', 'все', 'столько', 'также', 'притом',
            'причём', 'причем', 'есть', 'именно', 'когда', 'лишь', 'едва', 'будто',
            'точно', 'бы', 'коли', 'ежели', 'несмотря', 'на', 'хотя', 'хоть', 'пускай',
            'дабы', 'c', 'тем', 'ведь', 'чем', 'в то же время',
        ];
    }
}
