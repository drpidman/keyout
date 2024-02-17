<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm m-1 rounded ps-2 px-2 border border-secondary">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= $routes->getRoute("home-page")->pathname ?>">SiS Keyout</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= $routes->getRoute("home-page")->pathname ?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= $routes->getRoute("reservas-page")->pathname ?>">Reservas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= $routes->getRoute("salas-page")->pathname ?>">Salas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= $routes->getRoute("usuarios-page")->pathname ?>">Usuarios</a>
        </li>

        <li class="nav-item dropdown">
          <span class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Sistema
          </span>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item" href="<?= $routes->getRoute("sistema-page")->pathname ?>">
                Sugestões de melhoria / recursos
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="<?= $routes->getRoute("sistema-page")->pathname ?>">
                Problemas reportados
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>