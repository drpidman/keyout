<?php
include "../config.php";

if (isset($_GET["action"]) && $_GET["action"] == "new") {
    $nome_sala = $_POST["nome_sala"];

    $stmt = $pdo->prepare("INSERT INTO salas(nome) VALUES(:nome)");
    $stmt->bindParam(":nome", $nome_sala);
    $stmt->execute();

    header("Location: /salas");
}

if (isset($_GET["action"]) && $_GET["action"] == "edit") {
    $idsala = $_POST["id"];
    $nome_sala = $_POST["nome_sala"];

    $stmt = $pdo->prepare("UPDATE salas SET nome = :nome WHERE idsala = :id");
    $stmt->bindParam(":nome", $nome_sala);
    $stmt->bindParam(":id", $idsala);
    $stmt->execute();

    header("Location: /salas");
}

if (isset($_GET["action"]) && $_GET["action"] == "delete") {
    $idsala = $_POST["idsala"];

    $stmt = $pdo->prepare("SELECT * FROM reservas WHERE idsala = :id");
    $stmt->bindParam(":id", $idsala);
    $stmt->execute();

    try {
        $pdo->beginTransaction();

        if ($stmt->rowCount()) {
            $stmt = $pdo->prepare("DELETE FROM reservas WHERE idsala = :idsala");
            $stmt->bindParam(":idsala", $idsala);
            $stmt->execute();
        }

        $stmt = $pdo->prepare("DELETE FROM salas WHERE idsala = :idsala");
        $stmt->bindParam(":idsala", $idsala);
        $stmt->execute();

        $pdo->commit();

        header("Location: /salas");
    } catch (PDOException $e) {
        $pdo->rollBack();
        header("Location: /salas&erro=stmt_error_update");
        return;
    }
}
