<?php

error_reporting(E_ALL);

$db = parse_url(getenv("DATABASE_URL"));
$host='ec2-54-217-235-87.eu-west-1.compute.amazonaws.com';
$dbname = 'd4es7alaadvmih';
$username = 'zhtzkjcvxxjmfk';
$password = '0d089aae8342db654d90cb7cb2e652bdf303918af61f9d997f380a80aba204f0';
$dsn = "pgsql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password";

try {
    $pdo = new PDO($dsn);

	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling
//    $sql ="CREATE TABLE banks (ID serial PRIMARY KEY, Name VARCHAR(50) NOT NULL, Created timestamp);" ;
//    $pdo->exec($sql);
    
//    $sql ="CREATE TABLE users(ID serial PRIMARY KEY, Name VARCHAR(50) NOT NULL, Role integer NOT NULL, Created timestamp);" ;
//    $pdo->exec($sql);
    
//    $sql ="CREATE TABLE transactions (ID serial PRIMARY KEY, UID integer NOT NULL, BID integer NOT NULL, Grain integer NOT NULL, Wood integer NOT NULL, Stone integer NOT NULL, Iron integer NOT NULL, Gold integer NOT NULL, Created timestamp);";
//    $pdo->exec($sql);
    
    
//    var_dump($_POST);
//    if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') != 0){
//        throw new Exception('Request method must be POST!');
//    }
    if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') != 0) {
        include("template.php");
    } else {
        var_dump($_POST);
//        $stmt = $pdo->prepare("INSERT INTO transactions (uid, bid, Grain, Wood, Stone, Iron, Gold, Created) VALUES (:uid, :bid, :grain, :wood, :stone, :iron, :gold, :created)");
//        $stmt->bindParam(':uid', 1);
//        $stmt->bindParam(':bid', 1);
//        $stmt->bindParam(':grain', $email);
//        $stmt->bindParam(':wood', $email);
//        $stmt->bindParam(':stone', $email);
//        $stmt->bindParam(':iron', $email);
//        $stmt->bindParam(':gold', $email);
//        $stmt->bindParam(':created', $email);
//        
//        $sql = "INSERT INTO transactions (uid, bid, Grain, Wood, Stone, Iron, Gold, Created) VALUES (1, 1, 'alvin', now(), now());"
//        echo $stmt->execute();
        

    }
//    include("template.php");
    $pdo->close();
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
    
?>

