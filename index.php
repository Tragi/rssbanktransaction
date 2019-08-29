<?php 

error_reporting(E_ALL);

$db = parse_url(getenv("DATABASE_URL"));
var_dump($db);


$table = "transactions";
try {
     $pdo = new PDO("pgsql:" . sprintf(
   	"host=%s;port=%s;user=%s;password=%s;dbname=%s",
	$db["ec2-54-217-235-87.eu-west-1.compute.amazonaws.com"],
	$db["5432"],
	$db["zhtzkjcvxxjmfk"],
	$db["0d089aae8342db654d90cb7cb2e652bdf303918af61f9d997f380a80aba204f0"],
    	ltrim($db["d4es7alaadvmih"], "/")
	));

	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling
	$sql ="CREATE table transactions(
        ID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
        UID INT( 11 ) NOT NULL,
        BID INT( 11 ) NOT NULL,
        Grain INT( 11 ) NOT NULL,
        Wood INT( 11 ) NOT NULL,
        Stone INT( 11 ) NOT NULL,
        Iron INT( 11 ) NOT NULL,
        Gold INT( 11 ) NOT NULL,
        Created TIMESTAMP NOT NULL DEFAULT NOW();" ;
    $pdo->exec($sql);
    $sql ="CREATE table users(
        ID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
        Name VARCHAR( 50 ) NOT NULL,
        Rrole INT ( 11 ) NOT NULL,
        Created TIMESTAMP NOT NULL DEFAULT NOW();" ;
    $pdo->exec($sql);

    $sql ="CREATE table banks(
    ID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR( 50 ) NOT NULL,
    Created TIMESTAMP NOT NULL DEFAULT NOW();" ;
    $pdo->exec($sql);

    
} catch(PDOException $e) {
    echo $e->getMessage();//Remove or change message in production code
}

?>
