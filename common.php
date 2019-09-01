<?php
    session_start();
    
    ini_set('display_errors', '1');
    ini_set('error_reporting', E_ALL);
    error_reporting(E_ALL);
    
    $db = parse_url(getenv("DATABASE_URL"));
    $host='ec2-54-217-235-87.eu-west-1.compute.amazonaws.com';
    $dbname = 'd4es7alaadvmih';
    $username = 'zhtzkjcvxxjmfk';
    $password = '0d089aae8342db654d90cb7cb2e652bdf303918af61f9d997f380a80aba204f0';
    $dsn = "pgsql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password";
    
    $bankID = isset($_COOKIE["bank"]) ? $_COOKIE["bank"] : 1;
    
    function solveUser() {
        global $_POST, $_SESSION, $pdo;
        
        $userName = "Anonym";
        if (isset($_POST["user"])) {
            $user = trim($_POST["user"]);
            $stmt = $pdo->prepare("SELECT * FROM users WHERE Name = :name");
            $stmt->bindParam(':name', $user);
            $stmt->execute();
            $row = $stmt->fetch();
            $userId = 0;
            if (!$row) {
                $userName = $user;
                $stmt = $pdo->prepare("INSERT INTO users (Name, Role, Created) VALUES (:name, 1, :created)");
                $stmt->bindParam(':name', $user);
                $stmt->bindValue(':created', date('Y-m-d H:i:s'));
                $stmt->execute();
                $userId = $pdo->lastInsertId();
            } else {
                $userId = $row["id"];
                $userName = $row["name"];
            }
            $_SESSION["userID"] = $userId;
        } elseif (isset($_SESSION["userID"])) {
            $_SESSION["userID"] = $_SESSION["userID"];
            $stmt = $pdo->prepare("SELECT * FROM users WHERE Id = :id");
            $stmt->bindParam(':id', $_SESSION["userID"]);
            $stmt->execute();
            $row = $stmt->fetch();
            if ($row) {
                $userName = $row["name"];
            }
        }
        
        return $userName;
    }
    
    function bankOptions() {
        global $bankID;
        $banks = [1 => "Sezam",2 => "Agro"];
        $return = "";
        foreach($banks as $key=>$value) {
            $selected = $bankID == $key ? "selected=\"selected\"" : "";
            $return = $return."<option $selected value=\"$key\">$value</option>";
        }
        //
        return $return;
    }
    
    function echoSummaryTransactions() {
        global $pdo, $bankID;
        $stmt = $pdo->prepare("SELECT transactions.uid, users.name, SUM(transactions.grain) AS grain, SUM(transactions.wood) AS grain, SUM(transactions.wood) AS wood, SUM(transactions.stone) AS stone, SUM(transactions.iron) AS iron, SUM(transactions.gold) AS gold FROM transactions LEFT JOIN users ON transactions.uid = users.id WHERE transactions.bid = :bid GROUP BY transactions.uid, users.name ORDER BY users.name ASC");
        $stmt->bindValue(':bid', $bankID);
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
            $grainClass = $row["grain"] > 0 ? "table-success" : ($row["grain"] == 0 ? "table-light" : "table-danger");
            $woodClass = $row["wood"] > 0 ? "table-success" : ($row["wood"] == 0 ? "table-light" : "table-danger");
            $stoneClass = $row["stone"] > 0 ? "table-success" : ($row["stone"] == 0 ? "table-light" : "table-danger");
            $ironClass = $row["iron"] > 0 ? "table-success" : ($row["iron"] == 0 ? "table-light" : "table-danger");
            $goldClass = $row["gold"] > 0 ? "table-success" : ($row["gold"] == 0 ? "table-light" : "table-danger");
            echo "<tr class='table-'><td style=\"width:100px\">$name</td><td class=\"$grainClass\" style=\"width:120px\">$grain</td><td class=\"$woodClass\" style=\"width:120px\">$wood</td><td class=\"$stoneClass\" style=\"width:120px\">$stone</td><td class=\"$ironClass\" style=\"width:120px\">$iron</td><td class=\"$goldClass\" style=\"width:120px\">$gold</td></tr>";
        }
        $grain = number_format($sumGrain, 0, ',', ' ');
        $wood = number_format($sumWood, 0, ',', ' ');
        $stone = number_format($sumStone, 0, ',', ' ');
        $iron = number_format($sumIron, 0, ',', ' ');
        $gold = number_format($sumGold, 0, ',', ' ');
        $grainClass = $sumGrain > 0 ? "table-success" : ($sumGrain == 0 ? "table-light" : "table-danger");
        $woodClass = $sumWood > 0 ? "table-success" : ($sumWood == 0 ? "table-light" : "table-danger");
        $stoneClass = $sumStone > 0 ? "table-success" : ($sumStone == 0 ? "table-light" : "table-danger");
        $ironClass = $sumIron > 0 ? "table-success" : ($sumIron == 0 ? "table-light" : "table-danger");
        $goldClass = $sumGold > 0 ? "table-success" : ($sumGold == 0 ? "table-light" : "table-danger");
        return "<tr><td class='table-primary' scope=\"col\" style=\"width:100px\">Součet</td><td class=\"$grainClass\" scope=\"col\" style=\"width:120px\">$grain</td><td class=\"$woodClass\" scope=\"col\" style=\"width:120px\">$wood</td><td class=\"$stoneClass\" scope=\"col\" style=\"width:120px\">$stone</td><td class=\"$ironClass\" scope=\"col\" style=\"width:120px\">$iron</td><td class=\"$goldClass\" scope=\"col\" style=\"width:120px\">$gold</td></tr>";
    }
    
    
    function echoTransactions() {
        global $pdo, $bankID;
        $stmt = $pdo->prepare("SELECT * FROM transactions WHERE uid = :uid AND bid = :bid ORDER BY id DESC");
        $stmt->bindValue(':uid', isset($_SESSION["userID"]) ? $_SESSION["userID"] : 0);
        $stmt->bindValue(':bid', $bankID);
        
        $stmt->execute();
        $sumGrain = 0;$sumWood = 0;$sumStone = 0;$sumIron = 0;$sumGold = 0;
        while ($row = $stmt->fetch()) {
            //        var_dump($row);
            $class = $row["type"] == 1 ? "success" : "danger";
            $created = $row["created"];
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
            echo "<tr class='table-$class'><td style=\"width:220px\">$created</td><td style=\"width:120px\">$grain</td><td style=\"width:120px\">$wood</td><td style=\"width:120px\">$stone</td><td style=\"width:120px\">$iron</td><td style=\"width:120px\">$gold</td></tr>";
        }
        $grain = number_format($sumGrain, 0, ',', ' ');
        $wood = number_format($sumWood, 0, ',', ' ');
        $stone = number_format($sumStone, 0, ',', ' ');
        $iron = number_format($sumIron, 0, ',', ' ');
        $gold = number_format($sumGold, 0, ',', ' ');
        return "<tr class='table-primary'><td scope=\"col\" style=\"width:220px\">Součet</td><td scope=\"col\" style=\"width:120px\">$grain</td><td scope=\"col\" style=\"width:120px\">$wood</td><td scope=\"col\" style=\"width:120px\">$stone</td><td scope=\"col\" style=\"width:120px\">$iron</td><td scope=\"col\" style=\"width:120px\">$gold</td></tr>";
    }
    
    function createTransaction() {
        global $pdo, $_POST;
        $multiplier = isset($_POST["transaction"]) ? 1 : -1;
        $stmt = $pdo->prepare("INSERT INTO transactions (uid, bid, Grain, Wood, Stone, Iron, Gold, Created, Type) VALUES (:uid, :bid, :grain, :wood, :stone, :iron, :gold, :created, :type)");
        $stmt->bindParam(':uid', $_SESSION["userID"]);
        $stmt->bindParam(':bid', $_POST["bank"]);
        $stmt->bindValue(':type', isset($_POST["transaction"]) ? 1 : 0);
        $stmt->bindValue(':grain', $_POST["grain"] * $multiplier);
        $stmt->bindValue(':wood', $_POST["wood"] * $multiplier);
        $stmt->bindValue(':stone', $_POST["stone"] * $multiplier);
        $stmt->bindValue(':iron', $_POST["iron"] * $multiplier);
        $stmt->bindValue(':gold', $_POST["gold"] * $multiplier);
        $stmt->bindValue(':created', date('Y-m-d H:i:s'));
        $stmt->execute();
    }
    
?>
