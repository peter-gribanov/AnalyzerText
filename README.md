[![Latest Stable Version](https://img.shields.io/packagist/v/gribanov/analyzer-text.svg?maxAge=3600&label=stable)](https://packagist.org/packages/gribanov/analyzer-text)
[![PHP from Travis config](https://img.shields.io/travis/php-v/peter-gribanov/AnalyzerText.svg?maxAge=3600)](https://packagist.org/packages/gribanov/analyzer-text)
[![Build Status](https://img.shields.io/travis/peter-gribanov/AnalyzerText.svg?maxAge=3600)](https://travis-ci.org/peter-gribanov/AnalyzerText)
[![Coverage Status](https://img.shields.io/coveralls/peter-gribanov/AnalyzerText.svg?maxAge=3600)](https://coveralls.io/github/peter-gribanov/AnalyzerText?branch=master)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/peter-gribanov/AnalyzerText.svg?maxAge=3600)](https://scrutinizer-ci.com/g/peter-gribanov/AnalyzerText/?branch=master)
[![StyleCI](https://styleci.io/repos/9087072/shield?branch=master)](https://styleci.io/repos/9087072)
[![License](https://img.shields.io/packagist/l/gribanov/analyzer-text.svg?maxAge=3600)](https://github.com/peter-gribanov/AnalyzerText)

Анализатор текста
=================

Инструмент для анализа произвольного текста и получения из него максимум информации

Текс
----

Текс в приложени представляется в виде объектна-итератора и соответственно ячейкой итератора является объект слова.

```php
$text = '...'; // некоторый текст
$text_obj = new \AnalyzeText\Text($text);
// @var $word \AnalyzeText\Text\Word
$word = $text_obj->current();
```

Получив слово можно получить как его оригинальную форму так и форму в нижнем регистре для анализа.

*Текст на входе ожидается в кодировке UTF-8*

Анализаторы
-----------

Для анализа можно использовать предустановленные анализаторы передавая им объект текса.

* `Frequency` - подсчитывает частоту появления слова в тексте и процентное отнашение частоту появления к самому популярному слову.

Фильтры
-------

Набор фильтров для чистки текста содержащие более чем 3000 слов в библиотеке.

* `Adverb` - наречия
* `Interjection` - междометья
* `Particle` - частицы
* `Preposition` - предлоги
* `Pronoun` - местоимения
* `Union` - союзы
* `Informative` - информационные слова(фильтрует все описынные выше)

Использование
-------------

Пример реализации анализа естественности текста для SEO оптимизации.

```php
$frequency = new Frequency();
$frequency->setText(new Text($text));

// анализируем весь список слов
$graph = array_slice(array_merge_recursive($frequency->getFrequency(), $frequency->getPercent()), 0, 20);

// фильтруем и получаем только информационные слова
$frequency->applyFilters()->Informative();
$graph_filter = array_slice(array_merge_recursive($frequency->getFrequency(), $frequency->getPercent()), 0, 20);
```

<img src="example.png" align="center">

Производительность

Для анализа производительности использовался следующий код

```php
$i = $ii = 1000;
$start = microtime(1);
while ($i--) {
    $frequency = new Frequency();
    $frequency->setText(new Text($text))->applyFilters()->Informative();
    $frequency->getFrequency();
    $frequency->getPercent();
}
echo (microtime(1) - $start) / $ii;
```

Для теста взят текст в 15190 символов, 2707 слов.

Результат: ~0.29 c.

Лицензия
--------

Этот пакет находится под [лицензией MIT](https://opensource.org/licenses/MIT). Смотрите полную лицензию в файле: LICENSE
