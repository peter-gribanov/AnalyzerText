<?php

spl_autoload_register(function ($classname){
	$filename = __DIR__.'/'.str_replace('\\', '/', $classname).'.php';
	if (is_readable($filename)) {
		require $filename;
		return true;
	}
	return false;
});

$text = 'порверка както-то так-с';

$frequency = new \AnalyzerText\Analyzer\Frequency();
$frequency->setText(new \AnalyzerText\Text($text));

// аналезируем вечь список слов
var_dump(array_slice($frequency->getFrequency(), 0, 20));
var_dump(array_slice($frequency->getPercent(), 0, 20));

// фильтруем и получаем только информативные слова
$frequency->applyFilters()->Informative();
var_dump(array_slice($frequency->getFrequency(), 0, 20));
var_dump(array_slice($frequency->getPercent(), 0, 20));