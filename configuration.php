<?php
    //connect to server and select database
    $username = "nixx";
    $password = "7BBC610C4A815FD0DB49F7094AF36F9D3E0C4EE43B9C380660346C4ACE8403AF";
    $symbol = $_POST['symbol'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=stockmarket', $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
        
        $sql = 'SELECT * FROM '.$symbol.' WHERE date between :startDate and :endDate';
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
                ':startDate'   => $startDate,
                ':endDate'   => $endDate
            ));
  
 $arrValues = $stmt->fetchAll(PDO::FETCH_ASSOC);
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