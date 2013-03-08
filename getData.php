<?php
include("includes/configuration.php");
doDB();

function createURL($ticker){
	$currentMonth = date("n");
	$currentMonth = $currentMonth - 1;
	$currentDay = date("j");
	$currentYear = date("Y");
	//return "http://ichart.finance.yahoo.com/table.csv?s=$ticker&d=$currentMonth&e=$currentDay&f=$currentYear&g=d&a=$currentMonth&b=$currentDay&c=2009&ignore=.csv";
    return "http://ichart.finance.yahoo.com/table.csv?s=GOOG&d=3&e=8&f=2013&g=d&a=3&b=$8&c=2009&ignore=.csv";
}

//Gets content from url amd saves to $content
function getCSVFile($url, $outputFile){
	$content = file_get_contents($url);
	//Delete the top banner
	$content = str_replace("Date,Open,High,Low,Close,Volume,Adj Close", "", $content);
	$content = trim($content);
	file_put_contents($outputFile, $content);
} 

function fileToDatabase($txtFile, $tableName) {
	$file = fopen($txtFile, "r");
	//Loops till end of file
	while(!feof($file)) {
		// Takes one line and saves it to $line
		$line = fgets($file);
		// Deliminate using a comma, save to array called pieces
		$pieces = explode(",", $line);
		$date = $pieces[0];
		$open = $pieces[1];
		$high = $pieces[2];
		$low = $pieces[3];
		$close = $pieces[4];
		$volume = $pieces[5];
		$amount_change = $close-$open;
		$percent_change = ($amount_change/$open)*100;
	
		//Checks if table exists
		//returns true or false
		$sql = "SELECT * FROM $tableName";
		$result = mysql_query($sql);
		
		// Create table if it doesnt exist
		if(!result){
		$sql = "CREATE TABLE $tableName (date DATE, PRIMATE KEY(date), open FLOAT, high FLOAT, low FLOAT, close FLOAT, volume INT, amount_change FLOAT, percent_change FLOAT;)";
		mysql_query($sql);
		}
		
		$sql = "INSERT INTO $tableName (date, open, high, low, close, volume, amount_change, percent_change) VALUES ('$date', '$open', '$high', '$low', '$close', '$volume', '$amount_change', '$percent_change')";
		mysql_query(sql);	
	}
	//close file
	fclose($file);
}

function main() {
	$mainTickerFile = fopen("tickerMaster.txt","r");
	while(!feof($mainTickerFile)) {
		$companyTicker = fgets($mainTickerFile);
		$fileURL = createURL($companyTicker);
		$companyTxtFile = "txtFiles/".$companyTicker.".txt";
		getCSVFile($fileURL, $companyTxtFile);
		fileToDatabase($companyTxtFile, $companyTicker);
		
		}
}
?>
