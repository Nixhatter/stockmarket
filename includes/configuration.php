<?php

function pdoDB() {
	//connect to server and select database
    $username = "nixx";
    $password = "7BBC610C4A815FD0DB49F7094AF36F9D3E0C4EE43B9C380660346C4ACE8403AF";
    $id = "AAPL";
    try {
        $conn = new PDO('mysql:host=localhost;dbname=stockmarket', $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
         
        $stmt = $conn->prepare('SELECT * FROM :id');
        $stmt->execute(array('id' => $id));
     
        $result = $stmt->fetchAll();
 
      if ( count($result) ) { 
        foreach($result as $row) {
          print_r($row);
        }   
      } else {
        echo "No rows returned.";
      }
    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
?>
