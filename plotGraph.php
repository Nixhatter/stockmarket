<?php
include("includes/configuration.php");
pdoDB();

function getArray(){

	$sql = "SELECT date, amount_change FROM GOOG";

	$statement = $pdo->prepare($sql);
	$statement->execute();

	// <http://www.php.net/manual/en/pdostatement.fetchall.php>
    $array = $statement->fetchAll(PDO::FETCH_ASSOC);
    unset($statement);
    }
?>