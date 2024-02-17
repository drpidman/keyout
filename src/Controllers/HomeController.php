<?php

namespace App\Controllers;

use App\Models\Professor;
use App\Models\ProfessoresModel;
use App\RouteCollection;

class HomeController extends Controller
{
    public function show(RouteCollection $routes)
    {
        return $this->view("home", ["routes" => $routes]);
    }
}
