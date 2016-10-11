<?php
require_once "csv_manager.php";
require_once "library_size.php";

$libSize = new LibrarySize();
$csvManager = new CsvManager();
$rows = $csvManager->getData('1.csv');
$head = array_shift($rows);
$indexParamsCeil = $csvManager->getIndexParam($head);

if($indexParamsCeil){
	foreach($rows as &$row) {
		if(preg_match('/размер.?(\d+)/ui',$row[$indexParamsCeil], $result)){
			$row[] = $result[1];
			$row[] = $libSize->translateSize($result[1]);
		}		
	}
}
$head[] = 'Размер';
$head[] = 'Размер в международном формате';
array_unshift($rows, $head);

$csvManager->sendDataAsCsv($rows, 'test.csv');