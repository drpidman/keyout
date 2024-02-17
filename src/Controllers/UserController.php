<?php

namespace App\Controllers;

use App\Entity\Professor;
use App\Models\ProfessoresModel;
use App\RouteCollection;

session_start();

class UserController extends Controller
{
    public function show(RouteCollection $routes)
    {
        $usuarios = (new ProfessoresModel())->getAll();

        return $this->view("usuarios/list", ["routes" => $routes, "users" => $usuarios]);
    }

    public function showUser(RouteCollection $routes)
    {
        if (!$_SESSION["user"]) {
            return $this->view("components/404");
        }

        $user_reg = intval($routes->getRoute("usuarios-view")->params[0]);

        if ($user_reg !== $_SESSION["user"]->nregistro) {
            return $this->view("components/404");
        }

        $usuario = (new ProfessoresModel())->findByReg(intval($_SESSION["user"]->nregistro));
        return $this->view("usuarios/usuario", ["routes" => $routes, "user" => $usuario]);
    }

    public function unlockEdition(RouteCollection $routes)
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") return $this->view("components/404");
        $nd_registro = intval($_POST["nd_registro"]);
        $userid = $_POST["user_id"];

        if ($nd_registro <= 0) {
            $this->redirect($_SERVER["HTTP_REFERER"] . "?error=Numero de registro inválido");
            return;
        }

        $usuarioModel = new ProfessoresModel();
        $usuario = $usuarioModel->findByReg($nd_registro);

        if ($usuario->idusuario != $userid) {
            $this->redirect($_SERVER["HTTP_REFERER"] . "?error=Usuário não autorizado para edição. Este numero de registro é invalido para este usuário");
            return;
        }

        if ($usuario) {
            $_SESSION["user"] = $usuario;

            $this->redirect($routes->getRoute("usuarios-page")->pathname . "/" . $usuario->nregistro);
        } else {
            $this->redirect($_SERVER["HTTP_REFERER"]);
            return;
        }
    }

    public function editUser(RouteCollection $routes)
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") return $this->view("components/404");

        $userId = $routes->getRoute("usuarios-edit")->params[0];
        $nome_usuario = $_POST["nome_usuario"];
        $nd_registro = intval($_POST["nd_registro"]);

        if ($nd_registro <= 0) {
            $this->redirect($_SERVER["HTTP_REFERER"] . "?error=Numero de registro inválido");
            return;
        }

        $usuarioModel = new ProfessoresModel();

        $usuario = $usuarioModel->findById($userId);
        $usuario->nome = $nome_usuario;
        $usuario->nregistro = intval($nd_registro);

        $usuarioModel->edit($usuario);

        $_SESSION["user"] = $usuario;
        $this->redirect($routes->getRoute("usuarios-page")->pathname);
    }

    public function createUser(RouteCollection $routes)
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") return $this->view("components/404");
        $nome_usuario = $_POST["nome_usuario"];
        $nd_registro = intval($_POST["nd_registro"]);

        if ($nd_registro <= 0) {
            $this->redirect($_SERVER["HTTP_REFERER"] . "?error=Numero de registro inválido");
            return;
        }

        $usuario_model = new ProfessoresModel(new Professor(null, $nome_usuario, $nd_registro));

        $this->redirect($routes->getRoute("usuarios-page")->pathname);
    }

    public function deleteUser(RouteCollection $routes)
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") return $this->view("components/404");

        $userId = $routes->getRoute("usuarios-delete")->params[0];
        $usuarioModel = new ProfessoresModel();

        $usuario = $usuarioModel->findById($userId);
        $usuarioModel->delete($usuario);

        $_SESSION["user"] = null;
        $this->redirect($routes->getRoute("usuarios-page")->pathname);
    }

    public function showNewUser(RouteCollection $routes)
    {
        return $this->view("usuarios/novo", ["routes" => $routes]);
    }
}
