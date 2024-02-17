<?php

namespace App\Models;

use App\Entity\Salas;
use App\Models\Connection;
use PDO;
use PDOException;

class SalasModel extends Salas
{
    public function __construct(Salas $sala = null)
    {
        if (!$sala) return;

        $this->idsala = $sala->idsala;
        $this->nome = $sala->nome;
        $this->reservado = $sala->reservado;
        $this->listagem = $sala->listagem;
        return $this;
    }

    public function getAll()
    {
        $pdo = (new Connection())->getPdo();

        $stmt = $pdo->prepare("SELECT * FROM salas WHERE listagem = 'ativa' ORDER BY nome");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(int $sala_id)
    {
        $pdo =  (new Connection())->getPdo();

        $stmt = $pdo->prepare("SELECT * FROM salas WHERE idsala = :idsala");
        $stmt->bindParam(":idsala", $sala_id);
        $stmt->execute();

        $sala = $stmt->fetch(PDO::FETCH_OBJ);

        if (!$sala) {
            return null;
        }

        return new Salas($sala->idsala, $sala->nome, $sala->reservado, $sala->listagem);
    }

    public function updateName(Salas $sala)
    {
        $pdo =  (new Connection())->getPdo();

        $stmt = $pdo->prepare("UPDATE salas SET nome = :nome_sala WHERE idsala = :idsala");
        $stmt->bindParam(":nome_sala", $sala->nome, PDO::PARAM_STR);
        $stmt->bindParam(":idsala", $sala->idsala, PDO::PARAM_INT);

        $status = $stmt->execute();
    }

    public function setStatusById(bool $status, int $idsala)
    {
        $pdo = (new Connection())->getPdo();

        $stmt = $pdo->prepare("UPDATE salas SET reservado = :reservado WHERE idsala = :idsala AND listagem = 'ativa'");
        $stmt->bindParam(":reservado", $status, PDO::PARAM_BOOL);
        $stmt->bindParam(":idsala", $idsala);
        $status = $stmt->execute();

        return $status;
    }

    public function delete(Salas $salas) {
        $pdo = (new Connection())->getPdo();

        $reservas_model = new ReservasModel();
        $sala = (new SalasModel())->findById($salas->idsala);

        try {
            $pdo->beginTransaction();

            $reservas_model->deleteBySala($sala);

            $stmt = $pdo->prepare("DELETE FROM salas WHERE idsala = :idsala");
            $stmt->bindParam(":idsala", $salas->idsala, PDO::PARAM_INT);
            $status = $stmt->execute();

            $pdo->commit();
        } catch(PDOException $err) {
            $pdo->rollBack();
            die("Ocorreu um erro ao deletar registros: " . $err);
        }

        return $status;
    }
}
