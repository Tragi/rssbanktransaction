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
        $stmt = $pdo->prepare("SELECT transactions.uid, users.name, SUM(transactions.grain) AS grain, SUM(transactions.wood) AS grain, SUM(transactions.wood) AS wood, SUM(transactions.stone) AS stone, SUM(transactions.iron) AS iron, SUM(transactions.gold) AS gold FROM transactions LEFT JOIN users ON transactions.uid = users.id GROUP BY transactions.uid, users.name");
        $stmt->execute();
        
        $sumGrain = 0;$sumWood = 0;$sumStone = 0;$sumIron = 0;$sumGold = 0;
        while ($row = $stmt->fetch()) {
            $name = $row["name"];
            $sumGrain += $row["grain"];
            $sumWood += $row["wood"];
            $sumStone += $row["stone"];
            $sumIron += $row["iron"];
            $sumGold += $row["gold"];
            $grain = number_format($row["grain"], 0, ',', ' ');
            $wood = number_format($row["wood"], 0, ',', ' ');
            $stone = number_format($row["stone"], 0, ',', ' ');
            $iron = number_format($row["iron"], 0, ',', ' ');
            $gold = number_format($row["gold"], 0, ',', ' ');
            $grainClass = $row["grain"] > 0 ? "table-success" : ($row["grain"] == 0 ? "table-info" : "table-danger");
            $woodClass = $row["wood"] > 0 ? "table-success" : ($row["wood"] == 0 ? "table-info" : "table-danger");
            $stoneClass = $row["stone"] > 0 ? "table-success" : ($row["stone"] == 0 ? "table-info" : "table-danger");
            $ironClass = $row["iron"] > 0 ? "table-success" : ($row["iron"] == 0 ? "table-info" : "table-danger");
            $goldClass = $row["grain"] > 0 ? "table-success" : ($row["grain"] == 0 ? "table-info" : "table-danger");
            echo "<tr class='table-'><td class=\"$grainClass\" style=\"width:100px\">$name</td><td style=\"width:120px\">$grain</td><td class=\"$grainWood\" style=\"width:120px\">$wood</td><td class=\"$stoneClass\" style=\"width:120px\">$stone</td><td class=\"$ironClass\" style=\"width:120px\">$iron</td><td class=\"$goldClass\" style=\"width:120px\">$gold</td></tr>";
        }
        $grain = number_format($sumGrain, 0, ',', ' ');
        $wood = number_format($sumWood, 0, ',', ' ');
        $stone = number_format($sumStone, 0, ',', ' ');
        $iron = number_format($sumIron, 0, ',', ' ');
        $gold = number_format($sumGold, 0, ',', ' ');
        $grainClass = $row["grain"] > 0 ? "table-success" : ($row["grain"] == 0 ? "table-info" : "table-danger");
        $woodClass = $row["wood"] > 0 ? "table-success" : ($row["wood"] == 0 ? "table-info" : "table-danger");
        $stoneClass = $row["stone"] > 0 ? "table-success" : ($row["stone"] == 0 ? "table-info" : "table-danger");
        $ironClass = $row["iron"] > 0 ? "table-success" : ($row["iron"] == 0 ? "table-info" : "table-danger");
        $goldClass = $row["grain"] > 0 ? "table-success" : ($row["grain"] == 0 ? "table-info" : "table-danger");
        return "<tr class='table-primary'><td scope=\"col\" style=\"width:100px\">Součet</td><td class=\"$grainClass\" scope=\"col\" style=\"width:120px\">$grain</td><td class=\"$woodClass\" scope=\"col\" style=\"width:120px\">$wood</td><td class=\"$stoneClass\" scope=\"col\" style=\"width:120px\">$stone</td><td class=\"$ironClass\" scope=\"col\" style=\"width:120px\">$iron</td><td class=\"$goldClass\" scope=\"col\" style=\"width:120px\">$gold</td></tr>";
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
        
//            $sql ="DELETE FROM transactions;";
//            $pdo->exec($sql);
        
        include("summaryTemplate.php");
        
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
    ?>


