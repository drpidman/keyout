<?php
include "../config.php";
include "../utils.php";

if (isset($_GET["action"]) && $_GET["action"] == "new") {
    $nome_usuario = $_POST["nome_usuario"];
    $nd_registro = $_POST["nd_registro"];

    $stmt = $pdo->prepare("INSERT INTO usuarios(nome, nregistro) VALUES(:nome, :nd_registro)");
    $stmt->bindParam(":nome", $nome_usuario);
    $stmt->bindParam(":nd_registro", $nd_registro);
    $stmt->execute();

    header("Location:" . baseRedirect("usuarios"));
}

if (isset($_GET["action"]) && $_GET["action"] == "edit") {
    $id_usuario = $_POST["id"];
    $nome_usuario = $_POST["nome_usuario"];
    $nd_registro = $_POST["nd_registro"];

    $stmt = $pdo->prepare("UPDATE usuarios SET nome = :nome, nregistro = :nregistro WHERE idusuario = :id");
    $stmt->bindParam(":nome", $nome_usuario);
    $stmt->bindParam(":nregistro", $nd_registro);
    $stmt->bindParam(":id", $id_usuario);
    $stmt->execute();

    header("Location:" . baseRedirect("usuarios"));
}

if (isset($_GET["action"]) && $_GET["action"] == "delete") {
    $id_usuario = $_POST["user_id"];

    try {
        $pdo->beginTransaction();
        
        $stmt = $pdo->prepare("SELECT idsala FROM reservas WHERE idusuario = :idusuario");
        $stmt->bindParam(":idusuario", $id_usuario);
        $stmt->execute();
        
        while ($reserva = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $stmt = $pdo->prepare("UPDATE salas SET reservado = false WHERE idsala = :idsala AND listagem = 'ativa'");
            $stmt->bindParam(":idsala", $reserva["idsala"]);
            $stmt->execute();
        }

        $stmt = $pdo->prepare("DELETE FROM reservas WHERE idusuario = :idusuario");
        $stmt->bindParam(":idusuario", $id_usuario);
        $stmt->execute();
        
        $stmt = $pdo->prepare("DELETE FROM usuarios WHERE idusuario = :idusuario");
        $stmt->bindParam(":idusuario", $id_usuario);
        $stmt->execute();

        $pdo->commit();

        header("Location:" . baseRedirect("usuarios"));
    } catch (PDOException $e) {
        $pdo->rollBack();
        header("Location:" . baseRedirect("usuario?error=stmt_error_update"));
        return;
    }
}
