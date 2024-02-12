<?php

$db_name = "keyout";
$user = "root";
$pass = "@@root";

try {
    $pdo = new PDO("mysql:host=172.17.0.2;dbname=" . $db_name, $user, $pass);
} catch (PDOException $e) {
    echo "" . $e->getMessage();
    exit();
}
