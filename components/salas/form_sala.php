<?php
$action = "new";

if ($_GET['nova-sala'] == "edit") {
  $action = "edit";
} else {
  $action = "new";
}
?>

<section class="container mt-5">
  <div class="mb-3">
    <a href="/salas" class="btn btn-success">
      <i class="ri-arrow-left-wide-line"></i>
      Voltar
    </a>
  </div>

  <form class="rounded border p-3 mt-5" method="POST" action="/salas/actions.php?action=<?= $action ?>">
    <div class="mb-3">
      <h1 class="form-floating-h1 border-start border-end">
        <i class="ri-survey-line"></i>
        <?php
        if ($action == "edit") {
          echo "Editar sala";
        } else {
          echo "Nova sala";
        }
        ?>
      </h1>
      <section class="row gap-5 mb-3">
        <?php
        $stmt = $pdo->prepare("SELECT * FROM salas WHERE idsala = :id");
        if (isset($_GET["id"])) {
          $stmt->bindParam(":id", $_GET["id"]);
          $stmt->execute();
        }

        $usuario = $stmt->fetch(PDO::FETCH_OBJ);
        if ($usuario) :
        ?>
          <input name="id" type="hidden" value="<?= $usuario->idsala ?>">
          <div class="col-sm-6">
            <label class="form-label">Nome da sala</label>
            <input type="text" name="nome_sala" value="<?= $usuario->nome ?>" class="form-control" id="sala-input" aria-describedby="sala_help" required>
            <div id="sala_help" class="form-text">Um nome para indentificar a sala</div>
          </div>
        <?php else : ?>
          <div class="col-sm-6">
            <label class="form-label">Nome da sala</label>
            <input type="text" name="nome_sala" class="form-control" id="sala-input" aria-describedby="sala_help" required>
            <div id="sala_help" class="form-text">Um nome para indentificar a sala</div>
          </div>
        <?php endif ?>
      </section>
    </div>
    <button type="submit" class="btn btn-primary">
      <i class="ri-add-line"></i>
      Confirmar
    </button>
  </form>
</section>