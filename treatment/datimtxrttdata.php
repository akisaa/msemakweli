<?php
	$indicator = $_COOKIE['indicator'];
	$reportlevel = $_COOKIE['reportlevel'];
	include '../functions.php';
	$obj = new myFunctions;
	ini_set('memory_limit', '-1');
	ini_set('max_execution_time', 0);
	require_once "../vendor/autoload.php";

	$currentreportingyear = date('Y');
	$lastreportingmonth = date("m") - 1;
	$lastreportingmonthname = date("F", mktime(null, null, null, $lastreportingmonth));
	$lastreportingperiodyear = '';
	if($lastreportingmonth == 0){
		$lastreportingperiodyear = $currentreportingyear - 1;
	}else{
		$lastreportingperiodyear = $currentreportingyear;
	}

	$reportindicator = '';
	if($indicator == 'txcurr'){
		$reportindicator = 'txcurr';
	}
	else if($indicator == 'txnew'){
		$reportindicator = 'txnew';
	}
	else if($indicator == 'txrtt'){
		$reportindicator = 'txrtt';
	}
	else if($indicator == 'tis'){
		$reportindicator = 'transferin';
	}
	else if($indicator == 'deaths'){
		$reportindicator = 'deaths';
	}
	else if($indicator == 'tos'){
		$reportindicator = 'transferout';
	}
	else if($indicator == 'ltfu'){
		$reportindicator = 'ltfu';
	}
	else if($indicator == 'appointments'){
		$reportindicator = 'appointments';
	}
	else if($indicator == 'tracing'){
		$reportindicator = 'tracing';
	}
	else{
		$reportindicator = 'txcurr';
	}

	$lastreportingperiod = $_COOKIE['reportingperiod'];
	$reportingtable = 'patient'.$reportindicator;

	$reportresults = $obj->spdatimtxrttdata($lastreportingperiod,$reportingtable);

	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
	ini_set('memory_limit', '-1');
	$spreadsheet = new Spreadsheet();
	$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load("templates\datimtxrtttemplate.xlsx");
	$sheet = $spreadsheet->getActiveSheet();

	$sheet->setCellValueByColumnAndRow(4, 1, $lastreportingperiod);
	$sheet->setCellValueByColumnAndRow(4, 2, 'TxRTT');
	$i = 5;
	foreach($reportresults as $results){
		//print_r($results);
		//echo '<br>';
		$col = 1;
		foreach($results as $value){
			$sheet->setCellValueByColumnAndRow($col, $i, $value);
			$col++;
		}
		$i++;
	}

	$writer = new Xlsx($spreadsheet);
	$filename = $reportingtable.$lastreportingperiod.'.xlsx';
	$writer->save($filename);

	header('Content-disposition: attachment; filename='.$filename);
    header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Length: ' . filesize($filename));
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    ob_clean();
    flush(); 

    readfile($filename);
    unlink($filename);

?>