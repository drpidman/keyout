<?php
define("PROJECT_URL", "/keyout");

$db_name = "keyout";
$user = "root";
$pass = "1234";

try {
    $pdo = new PDO("mysql:host=172.17.0.3;dbname=" . $db_name, $user, $pass);
} catch (PDOException $e) {
    echo "" . $e->getMessage();
    exit();
}
