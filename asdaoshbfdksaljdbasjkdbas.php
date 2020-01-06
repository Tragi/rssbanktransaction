<?php
    include("common.php");
  
    try {
        $pdo = new PDO($dsn);
        
        $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling
        //    $sql ="CREATE TABLE banks (ID serial PRIMARY KEY, Name VARCHAR(50) NOT NULL, Created timestamp);" ;
        //    $pdo->exec($sql);

	//$stmt = $pdo->prepare("INSERT INTO banks (Name, Created) VALUES (:name, :created)");
        //$stmt->bindValue(':name', "Krtek");
        //$stmt->bindValue(':created', date('Y-m-d H:i:s'));
        //$stmt->execute();
        
        //    $sql ="CREATE TABLE users(ID serial PRIMARY KEY, Name VARCHAR(50) NOT NULL, Role integer NOT NULL, Created timestamp);" ;
        //    $pdo->exec($sql);
        
        //    $sql ="CREATE TABLE transactions (ID serial PRIMARY KEY, UID integer NOT NULL, BID integer NOT NULL, Grain integer NOT NULL, Wood integer NOT NULL, Stone integer NOT NULL, Iron integer NOT NULL, Gold integer NOT NULL, Created timestamp);";
        //    $pdo->exec($sql);
        
        //    var_dump($_POST);
        //    if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') != 0){
        //        throw new Exception('Request method must be POST!');
        //    }
        
//        $sql ="DELETE FROM transactions;";
//        $pdo->exec($sql);
//        
//        $sql ="DELETE FROM users;";
//        $pdo->exec($sql);
        
        
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
?>