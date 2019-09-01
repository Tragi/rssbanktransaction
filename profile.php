<?php
    include("common.php");
    
    try {
        $pdo = new PDO($dsn);
        
        $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling
        
        $userName = solveUser();
        
        if (!isset($_SESSION["userID"]) || (isset($_SESSION["userID"]) && $_SESSION["userID"] <= 0)) {
            include("login.html");
        } else {
            if (isset($_POST["user"])) {
                echo "hahahha";
                updateProfile();
            }
            include("profileTemplate.php");
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
    ?>


