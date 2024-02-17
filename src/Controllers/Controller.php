<?php

namespace App\Controllers;

class Controller
{
    public function view(string $view_name, array $arg = [])
    {
        extract($arg);
        include_once "../views/" . $view_name . ".php";
    }

    public function redirect(string $path) {
        header("Location:" . $path);
    }
}
