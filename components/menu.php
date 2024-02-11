<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= baseRedirect("") ?>">SiS Keyout</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= baseRedirect("") ?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= baseRedirect("reservas") ?>">Reservas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= baseRedirect("salas") ?>">Salas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= baseRedirect("usuarios") ?>">Usuarios</a>
        </li>
      </ul>
    </div>
  </div>
</nav>