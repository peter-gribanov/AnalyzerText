<?php
/**
 * AnalyzerText package.
 *
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */

namespace AnalyzerText\Filter\WordList;

/**
 * Оставляет в списке частицы.
 *
 * @author  Peter Gribanov <info@peter-gribanov.ru>
 */
class Particle extends WordList
{
    /**
     * Возвращает список слов.
     *
     * @return array
     */
    public function getWords()
    {
        return [
            // русские междометья
            'пусть', 'пускай', 'давайте', 'да', 'давай', 'бы,', 'б', 'бывало', 'не', 'ни', 'ли', 'неужели', 'разве', 'вот', 'вон',
            'именно', 'только', 'лишь', 'исключительно', 'единственно', 'как', 'даже', 'же', 'ведь', 'уж', 'все-таки',
            'пусть', 'бишь', 'вишь', 'де', 'дескать', 'ин',
            'ишь', 'мол', 'небось', 'нет', 'неужели', 'нехай', 'ну-с', 'сём', 'сем', 'таки', 'те', 'уж',
            'а', 'благо', 'более', 'больше', 'буквально', 'бывает', 'бывало', 'было', 'будто', 'ведь', 'во', 'вовсе', 'вон', 'вот', 'вроде',
            'всё', 'все', 'всего', 'где', 'гляди', 'да', 'давай', 'давайте', 'даже', 'дай', 'дайте', 'действительно', 'единственно', 'если',
            'ещё', 'знай', 'и', 'или', 'менно', 'как', 'какое', 'куда', 'ладно', 'ли', 'лучше', 'никак', 'ничего', 'нечего', 'однако',
            'окончательно', 'оно', 'поди', 'положительно', 'просто', 'прямо', 'пусть', 'пускай', 'разве', 'решительно', 'ровно', 'самое',
            'себе', 'скорее', 'словно', 'совершенно', 'спасибо', 'так', 'там', 'тебе', 'тоже', 'только', 'точно', 'хоть', 'чего', 'чисто',
            'что', 'чтоб', 'чтобы', 'эк', 'это',
            '*-ка', '*-то', '*-с',
            'вовсе не', 'далеко не', 'отнюдь не', 'почти что', 'как раз', 'что за', 'вряд ли', 'едва ли',

            // английские междометья
        ];
    }
}
