<?php
date_default_timezone_set("America/Sao_Paulo");

$renderPages = 10;

if (isset($_GET["limit"])) {
  $limit = $_GET["limit"];
  $renderPages = $limit + 5;
}

$sql_q = "SELECT rsv.idreserva,
rsv.criadoEm, rsv.atualizadoEm, rsv.periodo,
usr.nome as username, usr.nregistro,
sls.nome as roomname
FROM reservas rsv
INNER JOIN usuarios usr ON rsv.idusuario = usr.idusuario
INNER JOIN salas sls ON rsv.idsala = sls.idsala
";

if (isset($_GET["search"])) {
  $search = '%' . $_GET["search"] . '%';
  $sql_q .= 'WHERE usr.nome like :searchn OR sls.nome like :searchn OR rsv.periodo like :searchn';
}

$sql_q .= " ORDER BY 
CASE
 WHEN rsv.atualizadoEm IS NULL THEN rsv.criadoEm
 ELSE rsv.atualizadoEm
END DESC
LIMIT :sizef
";

$stmt = $pdo->prepare($sql_q);
$stmt->bindParam(":sizef", $renderPages, PDO::PARAM_INT);

if (isset($_GET["search"])) {
  $stmt->bindParam(":searchn", $search, PDO::PARAM_STR);
}
$stmt->execute();
?>

<section class="container mt-3">
  <div class="mb-3">
    <section class="mb-3">
      <a href="?nova-reserva=new" class="btn btn-primary">
        <i class="ri-add-fill"></i>
        Nova Reserva
      </a>
      <a href="?action=confirmar&method=search" class="btn btn-warning">
        <i class="ri-arrow-go-back-line"></i>
        Devolução
      </a>
    </section>

    <section class="mb-3">
      <h1><i class="ri-key-2-line"></i> Reservas</h1>
      <span class="badge fs-6 ps-3 rounded-pill text-bg-primary bg-opacity-10 border border-secondary text-dark"><i
          class="ri-checkbox-circle-fill"></i>
        Completa</span>
      <span class="badge fs-6 ps-3 rounded-pill text-bg-warning bg-opacity text-dark"><i class="ri-alert-line"></i>
        Pendente</span>
    </section>
  </div>

  <form class="input-group mt-4" action="<?= baseRedirect("reservas") ?>">
    <span class="input-group-text" id="basic-addon1"><i class="ri-search-2-line"></i></span>
    <input name="search" type="text" class="form-control" placeholder="Pesquisa" aria-label="Username"
      value="<?= $_GET["search"] ?>" aria-describedby="basic-addon1">
  </form>
  <?php if (isset($_GET["search"])): ?>
    <a class="btn btn-primary mt-2" href="<?= baseRedirect("reservas") ?>">Voltar</a>
  <?php endif ?>

  <?php if ($stmt->rowCount()): ?>
    <div class="d-flex flex-column gap-3 mt-3">
      <?php $itemCount = 0; ?>
      <div class="accordion accordion-flush" id="accordion-reserva">
        <?php while ($reserva = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
          <?php include "item_reservas.php" ?>
        <?php endwhile ?>
      </div>
      <?php if ($renderPages <= $stmt->rowCount()): ?>
        <form method="POST"
          action="<?= baseRedirect("reservas?limit=" . $renderPages) ?><?= isset($_GET["search"]) ? "&search=" . $_GET["search"] : "" ?>">
          <button class="btn btn-primary">carregar mais</button>
        </form>
      <?php elseif (isset($_GET["limit"])): ?>
        <a href="<?= baseRedirect("reservas") ?>" class="btn btn-primary">Voltar</a>
      <?php endif ?>
    <?php else: ?>
      <?php if ($stmt->rowCount() >= 0 && isset($_GET["search"])): ?>
        <div class="mb-3 border rounded p-3 mt-5">
          <h1>Nenhuma reserva foi econtrada</h1>
          <p class="text-gray">
            Ops, parece que nenhuma reserva foi econtrada com a sua pesquisa....
            <a href="<?= baseRedirect("reservas") ?>">Voltar</a>
          </p>
        </div>
      <?php else: ?>
        <div class="mb-3 border rounded p-3 mt-5">
          <h1>Nenhuma reserva foi criada</h1>
          <p class="text-gray">Para poder visualizar as reservas, por favor, adicione uma no botão "+ Nova reserva" ou
            clique aqui:
            <a href="?nova-reserva=new">
              <i class="ri-add-fill"></i>
              Nova Reserva
            </a>
          </p>
        </div>
      <?php endif ?>
    <?php endif ?>
  </div>
</section>