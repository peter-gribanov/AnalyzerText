Анализатор текста
============

Инструмент для анализа произвольного текста и получения из него максимум информации

## Текс

Текс в приложени представляется в виде объектна-итератора и соответственно ячейкой итератора является объект слова.
```php
$text = '...'; // некоторый текст
$text_obj = new \AnalyzeText\Text($text);
// @var $word \AnalyzeText\Text\Word
$word = $text_obj->current();
```

Получив слово можно получить как его оригинальную форму так и форму в нижнем регистре для анализа.

*Текст на входе ожидается в кодировке UTF-8*

## Анализаторы

Для анализа можно использовать предустановленные анализаторы передавая им объект текса.
* **Frequency** - подсчитывает частоту появления слова в тексте и процентное отнашение частоту появления к самому популярному слову.

## Фильтры

Набор фильтров для чистки текста содержащие более чем 3000 слов в библиотеке.
* **Adverb** - наречия
* **Interjection** - междометья
* **Particle** - частицы
* **Preposition** - предлоги
* **Pronoun** - местоимения
* **Union** - союзы
* **Informative** - информационные слова(фильтрует все описынные выше)

## Использование

Пример реализации анализа естественности текста для SEO оптимизации.
```php
$frequency = new \AnalyzerText\Analyzer\Frequency();
$frequency->setText(new \AnalyzerText\Text($text));

// анализируем весь список слов
$graph = array_slice(array_merge_recursive($frequency->getFrequency(), $frequency->getPercent()), 0, 20);

// фильтруем и получаем только информационные слова
$frequency->applyFilters()->Informative();
$graph_filter = array_slice(array_merge_recursive($frequency->getFrequency(), $frequency->getPercent()), 0, 20);
```

![alt text] (http://img62.imageshack.us/img62/5470/seoxv.png)

## Производительность

Для анализа производительности использовался следующий код
```php
$i = $ii = 1000;
$start = microtime(1);
while ($i--) {
	$frequency = new AnalyzeText_Analyzer_Frequency();
	$frequency->setText(new AnalyzeText_Text($text))->applyFilters()->Informative();
	$frequency->getFrequency();
	$frequency->getPercent();
}
echo (microtime(1)-$start)/$ii;
```

Для теста взят текст в 15190 символов, 2707 слов.

Результат: ~0.29 c.
