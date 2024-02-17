<?php

namespace App\Controllers;

use App\Models\ReservasModel;
use App\RouteCollection;

class ReservasController extends Controller
{

    public function show(RouteCollection $routes)
    {
        $reservas = (new ReservasModel())->getAll(isset($_GET["search"]) ? $_GET["search"] : null);
        return $this->view("reservas/list", ["routes" => $routes, "reservas" => $reservas]);
    }
}
