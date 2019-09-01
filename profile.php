<?php
    include("common.php");
    
    try {
        $pdo = new PDO($dsn);
        
        $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling
        
        $userName = solveUser();
        var_dump($_POST);
        if (!isset($_SESSION["userID"]) || (isset($_SESSION["userID"]) && $_SESSION["userID"] <= 0)) {
            include("login.html");
        } elseif (isset($_POST["user"])) {
            header("Status: 200");
            updateProfile();
            include("list.php");
        } else {
            include("profileTemplate.php");
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
    ?>


