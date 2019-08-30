<?php
    ini_set('display_errors', '1');
    ini_set('error_reporting', E_ALL);
    error_reporting(E_ALL);
    
    $db = parse_url(getenv("DATABASE_URL"));
    $host='ec2-54-217-235-87.eu-west-1.compute.amazonaws.com';
    $dbname = 'd4es7alaadvmih';
    $username = 'zhtzkjcvxxjmfk';
    $password = '0d089aae8342db654d90cb7cb2e652bdf303918af61f9d997f380a80aba204f0';
    $dsn = "pgsql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password";
    
    
    function echoTransactions() {
        global $pdo;
        $stmt = $pdo->prepare("SELECT transactions.uid, users.name, SUM(transactions.grain) AS grain, SUM(transactions.wood) AS grain, SUM(transactions.wood) AS grain, SUM(transactions.stone) AS stone, SUM(transactions.iron) AS iron, SUM(transactions.gold) AS gold FROM transactions LEFT JOIN users ON transactions.uid = users.id GROUP BY transactions.uid, users.name");
        $stmt->execute();
        
        $sumGrain = 0;$sumWood = 0;$sumStone = 0;$sumIron = 0;$sumGold = 0;
        while ($row = $stmt->fetchAll()) {
                    var_dump($row);
            $name = $row["name"];
            $sumGrain += $row["grain"] * ($row["type"] == 1 ? 1 : -1);
            $sumWood += $row["wood"] * ($row["type"] == 1 ? 1 : -1);
            $sumStone += $row["stone"] * ($row["type"] == 1 ? 1 : -1);
            $sumIron += $row["iron"] * ($row["type"] == 1 ? 1 : -1);
            $sumGold += $row["gold"] * ($row["type"] == 1 ? 1 : -1);
            $grain = number_format($row["grain"], 0, ',', ' ');
            $wood = number_format($row["wood"], 0, ',', ' ');
            $stone = number_format($row["stone"], 0, ',', ' ');
            $iron = number_format($row["iron"], 0, ',', ' ');
            $gold = number_format($row["gold"], 0, ',', ' ');
            echo "<tr class='table-$class'><td style=\"width:100px\">$name</td><td style=\"width:120px\">$grain</td><td style=\"width:120px\">$wood</td><td style=\"width:120px\">$stone</td><td style=\"width:120px\">$iron</td><td style=\"width:120px\">$gold</td></tr>";
        }
        $grain = number_format($sumGrain, 0, ',', ' ');
        $wood = number_format($sumWood, 0, ',', ' ');
        $stone = number_format($sumStone, 0, ',', ' ');
        $iron = number_format($sumIron, 0, ',', ' ');
        $gold = number_format($sumGold, 0, ',', ' ');
        return "<tr class='table-primary'><td scope=\"col\" style=\"width:100px\">Součet</td><td scope=\"col\" style=\"width:120px\">$grain</td><td scope=\"col\" style=\"width:120px\">$wood</td><td scope=\"col\" style=\"width:120px\">$stone</td><td scope=\"col\" style=\"width:120px\">$iron</td><td scope=\"col\" style=\"width:120px\">$gold</td></tr>";
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
        
        include("summaryTemplate.php");
        
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
    ?>


