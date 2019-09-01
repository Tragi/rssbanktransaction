<?php
include("common.php");
    
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

