<?php

namespace App\Controllers;

use App\Models\ProfessoresModel;
use App\Models\SalasModel;
use App\RouteCollection;
use App\RoutesCollection;
use PDOException;

session_start();

class SalasController extends Controller
{

    public function show(RouteCollection $routes)
    {
        $salas = (new SalasModel())->getAll();
        return $this->view("salas/list", ["routes" => $routes, "salas" => $salas]);
    }

    public function editSalaView(RouteCollection $routes)
    {
        if (!isset($_SESSION["user"])) {
            return $this->view("components/404");
        }

        $salaId = $routes->getRoute("salas-edit-page")->params;
        $sala = (new SalasModel())->findById(intval($salaId[0]));

        if (!$sala) {
            return $this->view("components/404");
        }

        return $this->view("salas/edit", ["routes" => $routes, "user" => $_SESSION["user"], "sala" => $sala]);
    }

    public function editSala(RouteCollection $routes)
    {
        if (!isset($_SESSION["user"])) return $this->view("components/404");
        $salaId = $routes->getRoute("salas-edit")->params[0];
        $nome_sala = $_POST["nome_sala"];

        $salas_model = new SalasModel();

        $sala = $salas_model->findById(intval($salaId));
        $sala->nome = $nome_sala;
        $salas_model->updateName($sala);

        return $this->redirect($routes->getRoute("salas-page")->pathname);
    }

    public function deleteSala(RoutesCollection $routes)
    {
        if (!isset($_SESSION["user"])) return $this->view("components/404");
        $salaId = $routes->getRoute("salas-delete")->params[0];

        $salas_model = new SalasModel();

        $sala = $salas_model->findById(intval($salaId));
        if (!$sala) {
            return $this->view("components/404");
        }

        $salas_model->delete($sala);

        return $this->redirect($routes->getRoute("salas-page")->pathname);
    }

    public function newRoomView(RoutesCollection $routes)
    {
        return $this->view("salas/new", ["routes" => $routes]);
    }

    public function unlockEdition(RoutesCollection $routes)
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") return $this->view("components/404");

        $nregistro = intval($_POST["nd_registro"]);
        $id_sala = $_POST["sala_id"];

        $salasModel = new SalasModel();
        $usuariosModel = new ProfessoresModel();

        $sala = $salasModel->findById($id_sala);
        $usuario = $usuariosModel->findByReg($nregistro);

        if (!$sala && !$usuario) {
            return $this->view("components/404");
        }

        $_SESSION["user"] = $usuario;

        return $this->redirect($routes->getRoute("salas-page")->pathname . "/" . $id_sala);
    }
}
