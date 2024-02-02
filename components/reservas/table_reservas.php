<?php
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
      <a href="?nova-reserva=new" class="btn btn-success">
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
      <span class="badge fs-6 ps-3 rounded-pill text-bg-info text-dark"><i class="ri-checkbox-circle-fill"></i> Completa</span>
      <span class="badge fs-6 ps-3 rounded-pill text-bg-warning bg-opacity-50 text-dark"><i class="ri-alert-line"></i> Pendente</span>
    </section>
  </div>

  <?php if ($stmt->rowCount() > 0) : ?>
    <div class="d-flex flex-column gap-3 mt-5">
      <?php while ($reserva = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
        <div class="d-flex p-3 border rounded mb-3
      <?php
        if (!$reserva["atualizadoEm"]) {
          echo "bg-warning bg-opacity-50";
        } else {
          echo "bg-info bg-opacity-50";
        }
      ?>">
          <div class="p-2 d-flex gap-3 flex-column">
            <h1>
              <i class="ri-key-2-line"></i>
              Reserva n° <?= $reserva["idreserva"] ?>
            </h1>

            <section class="ms-1">
              <div class="mb-2">
                <h5>
                  <i class="ri-user-line"></i>
                  <?= $reserva["username"] ?>
                </h5>
                <span class="fs-6 ps-3 ms-2 border-start border-dark">
                  <i class="ri-pass-valid-line"></i>
                  <?= $reserva["nregistro"] ?>
                </span>
              </div>
              <div>
                <span class="fs-6">
                  <i class="ri-home-line"></i>
                  <?= $reserva["roomname"] ?>
                </span>
              </div>
              <div>
                <span class="fs-6">
                  <i class="ri-time-line"></i>
                  <?= $reserva["periodo"] ?>
                </span>
              </div>
            </section>
            <section>
              <div class="mt-2">
                <i class="ri-calendar-line"></i>
                Data retirada:
                <span>
                  <?= date("d/m/Y H:i", strtotime($reserva["criadoEm"])); ?>
                </span>
              </div>
              <div class="mb-3">
                <i class="ri-calendar-line"></i>
                Data devolução:
                <span>
                  <?php
                  if ($reserva["atualizadoEm"]) : echo date("d/m/Y H:i", strtotime($reserva["atualizadoEm"])); ?>
                  <?php else : ?>
                    <i class="ri-error-warning-line"></i> Pendente
                  <?php endif ?>
                </span> 
              </div>
              <div>
                <?php if (!$reserva["atualizadoEm"]) : ?>
                  <a href="?action=confirmar&method=confirm&reserva=<?= $reserva["idreserva"] ?>" class="btn btn-warning">Concluir</a>
                <?php endif ?>
              </div>
            </section>
          </div>
        </div>
      <?php endwhile ?>
    <?php else : ?>
      <div class="mb-3 border rounded p-3 mt-5">
        <h1>Nenhuma reserva foi criada</h1>
        <p class="text-gray">Para poder visualizar as reservas, por favor, adicione uma no botão "+ Nova reserva" ou clique aqui:
          <a href="?nova-reserva=new">
            <i class="ri-add-fill"></i>
            Nova Reserva
          </a>
        </p>
      </div>
    <?php endif ?>
    </div>
</section>