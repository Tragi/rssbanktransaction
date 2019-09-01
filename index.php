<?php
include("common.php");
    
try {
    $pdo = new PDO($dsn);

	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling
    $userName = solveUser();
    
    if (!isset($_SESSION["userID"]) || (isset($_SESSION["userID"]) && $_SESSION["userID"] <= 0)) {
        include("login.html");
    } elseif (isset($_POST["bank"])) {
        header("Status: 200");
        createTransaction();
        include("list.php");
    } else {
        include("template.php");
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
    
?>

