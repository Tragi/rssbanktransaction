<?php 

error_reporting(E_ALL);

$db = parse_url(getenv("DATABASE_URL"));
$host='ec2-54-217-235-87.eu-west-1.compute.amazonaws.com';
$dbname = 'd4es7alaadvmih';
$username = 'zhtzkjcvxxjmfk';
$password = '0d089aae8342db654d90cb7cb2e652bdf303918af61f9d997f380a80aba204f0';
$dsn = "pgsql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password";

    echo $dsn;
    
try {
    $pdo = new PDO($dsn);

	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling
    $sql ="CREATE TABLE employees (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    reg_date TIMESTAMP
    )";
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
