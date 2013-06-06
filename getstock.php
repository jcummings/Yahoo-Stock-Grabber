<?php
	//This script is designed to be run at the command line, and expects arguments
	//supplied via the command line syntax
	//
	//This is because, with a lot of data, if you run this via a browser it is likely to 
	//surpass your connection timeout.
	//
	//If you wish to modify it to run in a browser, change the you'll need to convert
	//the arguments to local variables like so:
	//
	// $localvar1 = $_GET['argument1']
	// $localvar2 = $_GET['argument2']
	//
	//Syntax on command line:
	//
	//[PATH to PHP.EXE]\php.exe getstock.php tickersymbolfile.ext Output\\directory\\path
	//
	//Example: c:\program~1\php\php.exe getstock.php tickersymbols.txt e:\\inetpub\\wwwroot\\development\\stock\\
	//
	//Tickers symbol list should be a plain text list of all the tickers symbols you want to retrieve data from, 
	//with only one symbol on each line of the file.
	//
	//The return contains all historical pricing for a given symbol through the date the company
	//began public trading.
	//
	//Data is returned is CSV format in a series of files named SYMBOL.CSV in the speficied diretory
	//
	
	if(empty($argv[1])||empty($argv[2]) ){
		print "One of the required command line arguments is missing. Please see the getstock.php comments for more information.";
		die();
	}
	
	ini_set('auto_detect_line_endings',true);
	$fileName = $argv[1];
	$outputLocation = $argv[2];
	
    if(file_exists($fileName)) {     
    	$tickers = explode("\n", file_get_contents($fileName));
        $ch = curl_init();
      
        foreach ($tickers as $x){
        	$url = "http://ichart.finance.yahoo.com/table.csv?s=" . $x;    	        	
			$timeout = 30;
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			$data = curl_exec($ch);
			
			$file = $outputLocation.trim($x).".csv";
			
			$fh = fopen($file, "x+") or die("I can't seem to open the file: " .$file);
			fwrite($fh, $data);
			fclose($fh);
		}
		curl_close($ch);
	}		
	else{
        	print 'A list of ticker symbols is required for this script to run.  See the getstock.php comments for more information.';
	}       
?>