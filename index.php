<?php 

error_reporting(E_ALL);

$db = parse_url(getenv("DATABASE_URL"));
var_dump($db);

$pdo = new PDO("pgsql:" . sprintf(
    "host=%s;port=%s;user=%s;password=%s;dbname=%s",
    $db["ec2-54-217-235-87.eu-west-1.compute.amazonaws.com"],
    $db["5432"],
    $db["zhtzkjcvxxjmfk"],
    $db["0d089aae8342db654d90cb7cb2e652bdf303918af61f9d997f380a80aba204f0"],
    ltrim($db["d4es7alaadvmih"], "/")
));

var_dump($pdo);

?>