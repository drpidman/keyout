<?php

namespace App\Models;

use App\Entity\Professor;
use App\Entity\Reserva;
use App\Entity\Salas;
use App\Models\Connection;
use PDO;

class ReservasModel extends Reserva
{
    public function __construct(Reserva $reserva = null)
    {
        if (!$reserva) return;

        $this->idreserva = $reserva->idreserva;
        $this->periodo = $reserva->periodo;
        $this->idusuario = $reserva->idusuario;
        $this->idsala = $reserva->idsala;
        return $this;
    }

    public function getAll(string $query = null)
    {
        $pdo = (new Connection())->getPdo();

        $sql_query = "SELECT rsv.idreserva,
        rsv.criadoEm, rsv.atualizadoEm, rsv.periodo,
        usr.nome as username, usr.nregistro,
        sls.nome as roomname
        FROM reservas rsv
        INNER JOIN usuarios usr ON rsv.idusuario = usr.idusuario
        INNER JOIN salas sls ON rsv.idsala = sls.idsala ";

        if ($query) {
            $query = '%' . $query . '%';
            $sql_query .= "WHERE usr.nome like :searchn OR sls.nome like :searchn OR rsv.periodo like :searchn ";
        }

        $sql_query .= "
            ORDER BY 
            CASE
                WHEN rsv.atualizadoEm IS NULL THEN rsv.criadoEm
                ELSE rsv.atualizadoEm
            END DESC
        ";

        $stmt = $pdo->prepare($sql_query);

        if ($query) {
            $stmt->bindParam(":searchn", $query);
        }
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(int $idreserva)
    {
        $pdo = (new Connection())->getPdo();

        $stmt = $pdo->prepare("SELECT * FROM reservas WHERE idreserva = :idreserva");
        $stmt->bindParam(":idreserva", $idreserva);
        $stmt->execute();

        $reserva = $stmt->fetch(PDO::FETCH_OBJ);

        return new Reserva(
            $reserva->idreserva,
            $reserva->periodo,
            $reserva->idusuario,
            $reserva->idsala
        );
    }

    public function findByUserId(int $idusuario)
    {
        $pdo = (new Connection())->getPdo();

        $stmt = $pdo->prepare("SELECT * FROM reservas WHERE idusuario = :idusuario");
        $stmt->bindParam(":idusuario", $idusuario);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function delete(Reserva $reserva)
    {
        $pdo = (new Connection())->getPdo();

        $stmt = $pdo->prepare("DELETE FROM reservas WHERE idreserva = :idreserva");
        $stmt->bindParam(":idreserva", $reserva->idreserva);
        $status = $stmt->execute();

        return $status;
    }

    public function deleteBySala(Salas $salas) 
    {
        $pdo = (new Connection())->getPdo();

        $stmt = $pdo->prepare("DELETE FROM reservas WHERE idsala = :idsala");
        $stmt->bindParam(":idsala", $salas->idsala);
        $status = $stmt->execute();

        return $status;
    }

    public function deleteByUser(Professor $professor)
    {
        $pdo = (new Connection())->getPdo();

        $stmt = $pdo->prepare("DELETE FROM reservas WHERE idusuario = :idusuario");
        $stmt->bindParam(":idusuario", $professor->idusuario);
        $status = $stmt->execute();

        return $status;
    }
}
