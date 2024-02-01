<?php
$action = "new";

if ($_GET['novo-usuario'] == "edit") {
  $action = "edit";
} else {
  $action = "new";
}

?>
<section class="container mt-5">
  <div class="mb-3">
    <a href="/usuarios" class="btn btn-success">
      <i class="ri-arrow-left-wide-line"></i>
      Voltar
    </a>
  </div>

  <form class="rounded border p-3 mt-5" method="POST" action="/usuarios/actions.php?action=<?php echo $action ?>">
    <div class="mb-3">
      <h1 class="form-floating-h1 border-start border-end">
        <i class="ri-survey-line"></i>
        <?php
        if ($action == "edit") {
          echo "Editar usuario";
        } else {
          echo "Novo usuario";
        }
        ?>
      </h1>
      <section class="row flex-wrap gap-2 mb-3">
        <?php
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE idusuario = :id");
        if (isset($_GET["id"])) {
          $stmt->bindValue(":id", $_GET["id"]);
          $stmt->execute();
        }

        $usuario = $stmt->fetch(PDO::FETCH_OBJ);
        if ($usuario) {
        ?>
        <!-- SECTION PARA EDITAR O USUARIO -->
          <input type="hidden" value="<?php echo $usuario->idusuario ?>" name="id">
          <div class="col-sm-6">
            <label class="form-label">Nome completo</label>
            <input name="nome_usuario" type="text" class="form-control" id="nomeinput" aria-describedby="nomehelp" value="<?php echo $usuario->nome ?>" required>
            <div id="nomehelp" class="form-text">Nome para identificação</div>
          </div>
          <div class="col-sm-6">
            <label class="form-label">N. de registro</label>
            <input name="nd_registro" type="text" class="form-control" id="nregistroinput" aria-describedby="nregistrohelp" value="<?php echo $usuario->nregistro ?>" required>
            <div id="nregistrohelp" class="form-text">N. de registro, usado para identificação e para reservas</div>
          </div>
        <?php } else { ?>
        <!-- SECTION PARA CRIAR UM NOVO USUARIO -->
          <div class="col-sm-6 mt-sm-3 col-md-5">
            <label class="form-label">Nome completo</label>
            <input name="nome_usuario" type="text" class="form-control" id="nomeinput" aria-describedby="nomehelp" required>
            <div id="nomehelp" class="form-text">Nome para identificação</div>
          </div>
          <div class="col-sm-6 mt-sm-3 col-md-4">
            <label class="form-label">N. de registro</label>
            <input name="nd_registro" type="text" class="form-control" id="nregistroinput" aria-describedby="nregistrohelp" required>
            <div id="nregistrohelp" class="form-text">N. de registro, usado para identificação e para reservas</div>
          </div>
        <?php } ?>
      </section>
    </div>
    <?php if ($action == "edit") { ?>
      <button type="submit" class="btn btn-success">
        <i class="ri-user-add-line"></i>
        Confirmar
      </button>
    <?php } else { ?>
      <button type="submit" class="btn btn-primary">
        <i class="ri-user-add-line"></i>
        Adicionar
      </button>
    <?php } ?>
  </form>
</section>