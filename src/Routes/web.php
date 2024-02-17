<?php

use App\Route;
use App\RoutesCollection;

$routes = new RoutesCollection();
#GET
$routes->add("home-page", new Route("/", ["controller" => "HomeController", "method" => "show"]));
$routes->add("sistema-page", new Route("/sistema", ["controller" => "HomeController", "method" => "show"]));
#ENDGET

#GET - reservas
$routes->add("reservas-page", new Route("/reservas", ["controller" => "ReservasController", "method" => "show"]));
#ENDGET - reservas

#GET - salas
$routes->add("salas-page", new Route("/salas", ["controller" => "SalasController", "method" => "show"]));
$routes->add("salas-edit-page", new Route("/salas/:idsala", ["controller" => "SalasController", "method" => "editSalaView"]));
$routes->add("salas-new-page", new Route("/salas/nova-sala", ["controller" => "SalasController", "method" => "newRoomView"]));
#ENDGET - salas

#POST - salas
$routes->add("salas-edit-unlock", new Route("/salas/permissions/unlock", ["controller" => "SalasController", "method" => "unlockEdition"]));
$routes->add("salas-edit", new Route("/salas/:idsala/edit", ["controller" => "SalasController", "method" => "editSala"]));
$routes->add("salas-delete", new Route("/salas/:idsala/delete", ["controller" => "SalasController", "method" => "deleteSala"]));
#ENDPOST - salas

#GET - usuarios
$routes->add("usuarios-page", new Route("/usuarios", ["controller" => "UserController", "method" => "show"]));
$routes->add("usuarios-new-page", new Route("/usuarios/novo-usuario", ["controller" => "UserController", "method" => "showNewUser"]));
$routes->add("usuarios-view", new Route("/usuarios/:nreg", ["controller" => "UserController", "method" => "showUser"]));
$routes->add("usuarios-edit-unlock", new Route("/usuarios/permissions/unlock", ["controller" => "UserController", "method" => "unlockEdition"]));
#ENDGET - usuarios

#POST - usuarios
$routes->add("usuarios-new", new Route("/usuarios/novo-usuario/new", ["controller" => "UserController", "method" => "createUser"]));
$routes->add("usuarios-edit", new Route("/usuarios/:id/edit", ["controller" => "UserController", "method" => "editUser"]));
$routes->add("usuarios-delete", new Route("/usuarios/:id/delete", ["controller" => "UserController", "method" => "deleteUser"]));
#END-POST - usuarios
