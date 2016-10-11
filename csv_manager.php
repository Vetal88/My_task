<?php
class CsvManager {
	
	public function getData($file)
	{
		if (!is_file($file) || !is_readable($file)){
			throw new Exception('Incoreect file or not readable');
		}
		
		$rows = [];
		
		$handle = fopen($file, "r") or die("Error opening file ");
		if($handle){
			while (($buffer = fgetcsv($handle,0,";")) !== false){
				$rows[] = $buffer;
			}
			fclose($handle);
		}
		return $rows;
	}
	
	
	public function getIndexParam($head)
	{
		return array_search('param', array_map([$this, 'normalizeString'], $head));
	}
	
	public function normalizeString($str)
	{
		return strtolower(trim($str));
	}
	
	public function sendDataAsCsv($data, $fileName) 
	{
    header('Pragma: public');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Cache-Control: private', false);
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=' . $fileName);    
        $fp = fopen('php://output', 'w');

        foreach($data as $row){
			$r = array_map(function($d){return iconv('utf-8', 'windows-1251//TRANSLIT', $d);}, $row);
            fputcsv($fp, $r, ';');
        }
        fclose($fp);

	}
}