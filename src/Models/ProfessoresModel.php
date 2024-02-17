<?php

namespace App\Models;

use App\Entity\Professor;
use App\Models\Connection;
use PDO;
use PDOException;

class ProfessoresModel extends Professor
{
    public function __construct(Professor $user = null)
    {
        if (!$user) return;

        $pdo = (new Connection())->getPdo();
        $this->nome = $user->nome;
        $this->nregistro = $user->nregistro;

        $stmt = $pdo->prepare("INSERT INTO usuarios(nome, nregistro) VALUES(:nome, :nregistro)");
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":nregistro", $this->nregistro, PDO::PARAM_INT);
        $stmt->execute();

        $this->idusuario = $pdo->lastInsertId();
        return $this;
    }

    public function getAll()
    {
        $pdo = (new Connection())->getPdo();

        $stmt = $pdo->prepare("SELECT * FROM usuarios ORDER BY idusuario DESC");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByReg(int $nreg)
    {
        $pdo = (new Connection())->getPdo();

        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE nregistro = :nreg");
        $stmt->bindParam(":nreg", $nreg, PDO::PARAM_INT);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_OBJ);

        if (!$usuario) {
            return;
        }

        return new Professor($usuario->idusuario, $usuario->nome, $usuario->nregistro);
    }


    public function findById(int $idusuario)
    {
        $pdo = (new Connection())->getPdo();

        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE idusuario = :idusuario ORDER BY idusuario DESC");
        $stmt->bindParam(":idusuario", $idusuario);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_OBJ);

        return new Professor($usuario->idusuario, $usuario->nome, $usuario->nregistro);
    }

    public function edit(Professor $professor)
    {
        $pdo = (new Connection())->getPdo();

        $stmt = $pdo->prepare("UPDATE usuarios SET nome = :nome, nregistro = :nreg WHERE idusuario = :idusuario");
        $stmt->bindParam(":nome", $professor->nome);
        $stmt->bindParam(":nreg", $professor->nregistro, PDO::PARAM_INT);
        $stmt->bindParam(":idusuario", $professor->idusuario);
        $status = $stmt->execute();

        return $status;
    }

    public function delete(Professor $professor)
    {
        $pdo = (new Connection())->getPdo();

        try {
            $pdo->beginTransaction();

            $reservas_model = new ReservasModel();
            $reservas = $reservas_model->findByUserId($professor->idusuario);

            foreach ($reservas as $reserva) {
                (new SalasModel())->setStatusById(false, $reserva["idsala"]);
            }

            $reservas_model->deleteByUser($professor);

            $stmt = $pdo->prepare("DELETE FROM usuarios WHERE idusuario = :idusuario");
            $stmt->bindParam(":idusuario", $professor->idusuario);
            $status = $stmt->execute();

            $pdo->commit();
        } catch (PDOException $err) {
            $pdo->rollBack();
            die("Erro ao confirmar alterações no banco de dados: " . $err);
        }

        return $status;
    }
}
