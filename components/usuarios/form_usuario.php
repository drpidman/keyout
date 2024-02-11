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
    <a href="<?= baseRedirect("usuarios") ?>" class="btn btn-success">
      <i class="ri-arrow-left-wide-line"></i>
      Voltar
    </a>
  </div>

  <form class="rounded border p-3 mt-5" method="POST" action="<?= baseRedirect("usuarios/actions.php") ?>?action=<?= $action ?>">
    <div class="mb-3">
      <h1 class="form-floating-h1 border-start border-end">
        <i class="ri-survey-line"></i>
        <?php if ($action == "edit") : ?>
          Editar usuário
        <?php else : ?>
          Novo usuário
        <?php endif ?>
      </h1>
      <section class="row flex-wrap gap-2 mb-3">
        <?php
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE idusuario = :id");

        if (isset($_GET["id"])) {
          $stmt->bindValue(":id", $_GET["id"]);
          $stmt->execute();
        }

        $usuario = $stmt->fetch(PDO::FETCH_OBJ);
        ?>
        <input
        name="id"
        type="hidden"
        value="<?php if ($usuario) : echo $usuario->idusuario; endif ?>">
        
        <div class="col-sm-5">
          <label class="form-label">Nome completo</label>
          <input
          name="nome_usuario" type="text" 
          value="<?php if ($usuario) : echo $usuario->nome; endif ?>"
          class="form-control" id="nomeinput" aria-describedby="nomehelp" required>
          <div id="nomehelp" class="form-text">Nome para identificação</div>
        </div>
        <div class="col-sm-6">
          <label class="form-label">N. de registro</label>
          <input
          name="nd_registro" type="text" 
          value="<?php if ($usuario) : echo $usuario->nregistro; endif ?>" 
          class="form-control" id="nregistroinput" aria-describedby="nregistrohelp" required>
          <div id="nregistrohelp" class="form-text">N. de registro, usado para identificação e para reservas</div>
        </div>
      </section>
    </div>
    <button type="submit" 
    class="btn <?php if ($action == "edit") : echo "btn-success"; else : echo "btn-primary"; endif ?>">
      <?php if ($action == "edit") : ?>
        <i class="ri-edit-line"></i>
        Editar
      <?php else : ?>
        <i class="ri-user-add-line"></i>
        Adicionar
      <?php endif ?>
    </button>
  </form>
</section>