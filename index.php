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
    $stmt = $pdo->prepare("SELECT * FROM transactions WHERE uid = :id ORDER BY id DESC");
    $stmt->bindValue(':id', isset($_SESSION["userID"]) ? $_SESSION["userID"] : 0);
    $stmt->execute();
    $sumGrain = 0;$sumWood = 0;$sumStone = 0;$sumIron = 0;$sumGold = 0;
    while ($row = $stmt->fetch()) {
//        var_dump($row);
        $class = $row["type"] == 1 ? "success" : "danger";
        $created = $row["created"];
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
    
try {
    $pdo = new PDO($dsn);

	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling
    session_start();
    $userName = "Anonym";
    if (isset($_POST["user"])) {
        $user = trim($_POST["user"]);
        $stmt = $pdo->prepare("SELECT * FROM users WHERE Name = :name");
        $stmt->bindParam(':name', $user);
        $stmt->execute();
        $row = $stmt->fetch();
        $userId = 0;
        if (!$row) {
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
    
    if (!isset($_SESSION["userID"]) || (isset($_SESSION["userID"]) && $_SESSION["userID"] <= 0)) {
        include("login.html");
    } elseif (isset($_POST["bank"])) {
        header("Status: 200");
        createTransaction();
        include("list.php");
    } else {
        include("template.php");
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
    
?>

