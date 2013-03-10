<html>
    <head>
        <meta http-equiv="refresh" content="120" />
    </head>
<?php
include("includes/configuration.php");
doDB();

function createURL($ticker){
    $currentMonth = date("n");
    $currentMonth = $currentMonth - 1;
    $currentDay = date("j");
    $currentYear = date("Y");
    return "http://ichart.finance.yahoo.com/table.csv?s=$ticker&d=$currentMonth&e=$currentDay&f=$currentYear&g=d&a=12&b=30&c=2009&ignore=.csv";
}

function getCSVFile($url, $outputFile){
        if (file_exists($outputFile)) {
        }
        else {
            $content = file_get_contents($url);
            $content = str_replace("Date,Open,High,Low,Close,Volume,Adj Close", "", $content);
            $content = trim($content);
            file_put_contents($outputFile, $content);
        }
}

function fileToDatabase($txtFile, $tableName){
    Global $mysqli;    
    $file = fopen($txtFile,"r");
    
        $sql = "SELECT * FROM $tableName";
        $result = mysqli_query($mysqli, $sql);
        
        
        if(!$result){
            $sql2 = "CREATE TABLE $tableName (date DATE, PRIMARY KEY(date), open FLOAT, high FLOAT, low FLOAT, close FLOAT, volume INT, amount_change FLOAT, percent_change FLOAT)";
            if(mysqli_query($mysqli, $sql2) === TRUE) {
                //printf("created table");        
            //$numrows = mysql_num_rows($result);
        while(!feof($file)){
            $line = fgets($file);
            $pieces = explode(",", $line);

            $date = $pieces[0];
            $open = $pieces[1];
            $high = $pieces[2];
            $low = $pieces[3];
            $close = $pieces[4];
            $volume = $pieces[5];
            $amount_change = $close-$open;
            $percent_change = ($amount_change/$open)*100;
        
  
            $sql3 = "INSERT INTO $tableName (date, open, high, low, close, volume, amount_change, percent_change) VALUES ('$date','$open','$high','$low','$close','$volume','$amount_change','$percent_change')";
            mysqli_query($mysqli, $sql3); 
               }
        }
    }
    fclose($file);
   // mysqli_close($mysqli);
}

function main(){
    // Start timer
    $time_start = microtime(true);
    $mainTickerFile = fopen("tickerMaster.txt","r");
    while(!feof($mainTickerFile)){
        $companyTicker = fgets($mainTickerFile);
        $companyTicker = trim($companyTicker);
        
        //$fileURL = createURL($companyTicker);
        $companyTxtFile = "txtFiles/".$companyTicker.".txt";
        //getCSVFile($fileURL, $companyTxtFile);
        fileToDatabase($companyTxtFile, $companyTicker);
        $time_end = microtime(true);
        $time = $time_end - $time_start;
        if ($time > 100000000) {
           exit;
        }
    }
    printf("End of file reached");
}

main();
?>
</html>