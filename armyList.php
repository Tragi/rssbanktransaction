<?php
    include("common.php");
    
    try {
        $pdo = new PDO($dsn);
        
        $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling
        include("armyListTemplate.php");
        
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
    ?>
