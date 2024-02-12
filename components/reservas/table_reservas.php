<?php
date_default_timezone_set("America/Sao_Paulo");

$stmt = $pdo->prepare(
  "SELECT rsv.idreserva,
   rsv.criadoEm, rsv.atualizadoEm, rsv.periodo,
   usr.nome as username, usr.nregistro,
   sls.nome as roomname
  FROM reservas rsv
  INNER JOIN usuarios usr ON rsv.idusuario = usr.idusuario
  INNER JOIN salas sls ON rsv.idsala = sls.idsala
  ORDER BY 
    CASE
     WHEN rsv.atualizadoEm IS NULL THEN rsv.criadoEm
     ELSE rsv.atualizadoEm
    END DESC;
  "
);
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

  <?php if ($stmt->rowCount()): ?>
    <div class="d-flex flex-column gap-3 mt-5">
      <?php $itemCount = 0; ?>
      <div class="accordion accordion-flush" id="accordion-reserva">
        <?php while ($reserva = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
          <?php include "item_reservas.php" ?>
        <?php endwhile ?>
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
  </div>
</section>