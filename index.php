<?php

error_reporting(E_ALL);

$db = parse_url(getenv("DATABASE_URL"));
$host='ec2-54-217-235-87.eu-west-1.compute.amazonaws.com';
$dbname = 'd4es7alaadvmih';
$username = 'zhtzkjcvxxjmfk';
$password = '0d089aae8342db654d90cb7cb2e652bdf303918af61f9d997f380a80aba204f0';
$dsn = "pgsql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password";

function echoTransactions() {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM transactions WHERE uid = :id");
    $stmt->bindValue(':id', 1);
    $stmt->execute();
    while ($row = $stmt->fetchAll()) {
//        var_dump($row);
        $class = $row["type"] == 1 ? "success" : "danger";
        $created = $row["created"];
//        $grain = number_format($row["grain"], 0, ',', ' ');
//        $wood = number_format($row["wood"], 0, ',', ' ');
//        $stone = number_format($row["stone"], 0, ',', ' ');
//        $iron = number_format($row["iron"], 0, ',', ' ');
//        $gold = number_format($row["gold"], 0, ',', ' ');
//        echo "<tr class='table-$class'><td>$created</td><td>$grain</td><td>$wood</td><td>$stone</td><td>$iron</td><td>$gold</td></tr>";
    }
}
    
try {
    $pdo = new PDO($dsn);

	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling
//    $sql ="CREATE TABLE banks (ID serial PRIMARY KEY, Name VARCHAR(50) NOT NULL, Created timestamp);" ;
//    $pdo->exec($sql);
    
//    $sql ="CREATE TABLE users(ID serial PRIMARY KEY, Name VARCHAR(50) NOT NULL, Role integer NOT NULL, Created timestamp);" ;
//    $pdo->exec($sql);
    
//    $sql ="CREATE TABLE transactions (ID serial PRIMARY KEY, UID integer NOT NULL, BID integer NOT NULL, Grain integer NOT NULL, Wood integer NOT NULL, Stone integer NOT NULL, Iron integer NOT NULL, Gold integer NOT NULL, Created timestamp);";
//    $pdo->exec($sql);
    
//    $sql ="ALTER TABLE transactions ADD COLUMN Type integer NOT NULL;";
//    $pdo->exec($sql);
//    var_dump($_POST);
//    if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') != 0){
//        throw new Exception('Request method must be POST!');
//    }
    
    if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') != 0) {
        include("template.php");
    } else {
        header("Status: 200");
        x$stmt = $pdo->prepare("INSERT INTO transactions (uid, bid, Grain, Wood, Stone, Iron, Gold, Created, Type) VALUES (:uid, :bid, :grain, :wood, :stone, :iron, :gold, :created, :type)");
        $stmt->bindValue(':uid', 1);
        $stmt->bindValue(':bid', 1);
        $stmt->bindValue(':type', ($_POST["transaction"] == 'on') ? 1 : 0);
        $stmt->bindParam(':grain', $_POST["grain"]);
        $stmt->bindParam(':wood', $_POST["wood"]);
        $stmt->bindParam(':stone', $_POST["stone"]);
        $stmt->bindParam(':iron', $_POST["iron"]);
        $stmt->bindParam(':gold', $_POST["gold"]);
        $stmt->bindParam(':created', date('Y-m-d H:i:s'));
        $stmt->execute();
        include("list.php");
    }

    $pdo->close();
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
    
?>

