<?php

require __DIR__ . '/vendor/autoload.php';

$text = 'порверка как-то так-с';

$frequency = new \AnalyzerText\Analyzer\Frequency();
$frequency->setText(new \AnalyzerText\Text($text));

// анализируем весь список слов
var_dump(array_slice($frequency->getFrequency(), 0, 20));
var_dump(array_slice($frequency->getPercent(), 0, 20));

// фильтруем и получаем только информационные слова
$frequency->applyFilters()->Informative();
var_dump(array_slice($frequency->getFrequency(), 0, 20));
var_dump(array_slice($frequency->getPercent(), 0, 20));
