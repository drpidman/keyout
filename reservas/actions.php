<?php
include "../config.php";

function periodoMatcher(): String
{
    # Definir o timezone de date para America/Sao_Paulo
    # esmo que o sistema host defina isso, é bom garantir
    # que o codigo também confirme.
    date_default_timezone_set("America/Sao_Paulo");
    # Apenas utilizaremos a hora, ou seja, apenas as duas primeiras casas
    $horas = intval(date("H"));
    # Definimos uma string vazia apenas para retorno
    $str_periodo = "";
    # Fazemos as devidas condições para verificar a hora.
    # Cada hora ira corresponder a um periodo do dia.
    # Fazemos uma condição que verifica se a hora é menor ou igual a 11
    # caso nao seja, passe para a proxima condição e assim por diante.
    if ($horas <= 11) {
        $str_periodo = "Manhã";
    } else if ($horas <= 18) {
        $str_periodo = "Tarde";
    } else {
        $str_periodo = "Noite";
    }

    return $str_periodo;
}

if (isset($_GET["action"]) && $_GET["action"] == "new") {
    $nregistro = $_POST["nregistro"];
    $sala = $_POST["select_sala"];

    if (!$sala) {
        header("Location: /reservas?nova-reserva=new&erro=empty_sala");
        return;
    }

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE nregistro = :nregistro");
    $stmt->bindParam(":nregistro", $nregistro);
    $stmt->execute();

    if (!$stmt->rowCount()) {
        header("Location: /reservas?nova-reserva=new&sala=" . $sala . "&erro=user_not_found");
    }

    $usuario = $stmt->fetch(PDO::FETCH_OBJ);
    # Iniciar trasaction(operação ATOMIC).
    # A tabela reservas depende do estado de sala, se alguma dos statements falhar
    # todas irão ser canceladas e a função rollBack sera chamada.
    # isso evita que o banco de dados seja corrompido
    try {
        $pdo->beginTransaction();
        $periodo = periodoMatcher();

        # Insert reserva
        $stmt = $pdo->prepare(
            "INSERT INTO reservas(idusuario, idsala, periodo)
             VALUES(:idusuario, :idsala, :periodo)"
        );
        $stmt->bindParam(":idusuario", $usuario->idusuario);
        $stmt->bindParam(":idsala", $sala);
        $stmt->bindParam(":periodo", $periodo);
        $stmt->execute();

        # Update sala
        $stmt = $pdo->prepare(
            "UPDATE salas SET reservado = true
             WHERE idsala = :id"
        );
        $stmt->bindParam(":id", $sala);
        $stmt->execute();

        # Confirmar alterações
        $pdo->commit();
        header("Location: /reservas");
    } catch (PDOException $e) {
        # reverter alterações no banco de dados
        $pdo->rollBack();
        # redirecionar para a pagina principal com alguma mensagem de erro ou tipo de erro
        # nesse caso, tipo de erro: create_error, para saber que houve uma falha na criação
        header("Location: /reservas?nova-reserva=new&sala=" . $sala . "&erro=create_error");
        return;
    }
}

if (isset($_GET["action"]) && $_GET["action"] == "confirm") {
    $user_id = $_POST["user_id"];
    $select_sala = $_POST["select_sala"];
    $redirect = $_GET["redirect"];

    $stmt = $pdo->prepare(
        "SELECT * FROM usuarios
         WHERE idusuario = :id"
     );
    $stmt->bindParam(":id", $user_id);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_OBJ);

    if ($select_sala == "Selecione uma sala") {
        header("Location: /reservas?&erro=empty_sala&from_page=change_status&user_id=" . $user_id);
    }

    $stmt = $pdo->prepare(
        "SELECT * FROM reservas
         WHERE idusuario = :idusuario
         AND idsala = :idsala
         AND atualizadoEm IS NULL"
    );

    $stmt->bindParam(":idusuario", $usuario->idusuario);
    $stmt->bindParam(":idsala", $select_sala);
    $stmt->execute();
    $reserva = $stmt->fetch(PDO::FETCH_OBJ);

    try {
        $pdo->beginTransaction();

        $stmt = $pdo->prepare(
            "UPDATE reservas
             SET atualizadoEm = CURRENT_TIMESTAMP
             WHERE idreserva = :idreserva"
        );
        $stmt->bindParam(":idreserva", $reserva->idreserva);
        $stmt->execute();

        $stmt = $pdo->prepare(
            "UPDATE salas
             SET reservado = false 
             WHERE idsala = :idsala"
         );
        $stmt->bindParam(":idsala", $reserva->idsala);
        $stmt->execute();

        $pdo->commit();
        header("Location: " . $redirect);
    } catch (PDOException $err) {
        $pdo->rollBack();

        header("Location: /reservas?action=confirmar&erro=failed_to_update");
        return;
    }
}

if (isset($_GET["action"]) && $_GET["action"] == "get_reserved") {
    $nregistro = $_POST["nregistro"];

    $stmt = $pdo->prepare(
        "SELECT * FROM usuarios
         WHERE nregistro = :nregistro"
    );

    $stmt->bindParam(":nregistro", $nregistro);
    $stmt->execute();

    if (!$stmt->rowCount()) {
        header("Location: /reservas?erro=user_not_found&from_page=search");
        return;
    }

    $usuario = $stmt->fetch(PDO::FETCH_OBJ);
    header("Location: /reservas?action=confirmar&method=change_status&user_id=" . $usuario->idusuario);
}
