<?php
include "../config.php";

if (isset($_GET["action"]) && $_GET["action"] == "sugestion_new") {
    $req_from = $_SERVER['HTTP_REFERER'];
    $username = $_POST["username"];
    $sugestao = $_POST["sugestext"];
    $type = "sugestao";

    $stmt = $pdo->prepare("INSERT INTO systemreports(nome, descricao, type, from_page) VALUES(:nome, :sugestao, :type, :from_page)");
    $stmt->bindParam(":nome", $username);
    $stmt->bindParam(":sugestao", $sugestao);
    $stmt->bindParam(":type", $type);
    $stmt->bindParam(":from_page", $req_from);
    $stmt->execute();

    header("Location:" . $req_from);
}

if (isset($_GET["action"]) && $_GET["action"] == "problem_new") {
    $req_from = $_SERVER['HTTP_REFERER'];
    $username = $_POST["username"];
    $problema = $_POST["problemtext"];
    $type = "problema";

    $stmt = $pdo->prepare("INSERT INTO systemreports(nome, descricao, type, from_page) VALUES(:nome, :problema, :type, :from_page)");
    $stmt->bindParam(":nome", $username);
    $stmt->bindParam(":problema", $problema);
    $stmt->bindParam(":type", $type);
    $stmt->bindParam(":from_page", $req_from);
    $stmt->execute();

    header("Location:" . $req_from);
}