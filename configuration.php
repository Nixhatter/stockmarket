<?php

    include 'includes/configuration.php';
    //connect to server and select database
    
    $symbol = $_POST['symbol'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    try {    
         $database = new Database();
         $database->query($sql);
         
         $database->bind(':startDate', $startDate);
         $database->bind(':endDate', $endDate);
         
         $arrValues = $database->resultset();
        // open the table
        print "<table wdith=\"100%\">\n";
        print "<tr>\n";
        // add the table headers
        foreach ($arrValues[0] as $key => $useless){
            print "<th>$key</th>";
        }
        print "</tr>";
        // display data
        foreach ($arrValues as $row){
            print "<tr>";
            foreach ($row as $key => $val){
                print "<td>$val</td>";
            }
            print "</tr>\n";
        }
        // close the table
        print "</table>\n";
        
    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
    

?>