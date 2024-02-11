<?php
/**
 * Pre-query para carregar as salas ao carregar o componente sala
 */
$stmt = $pdo->prepare("SELECT * FROM salas WHERE listagem = 'ativa'");
$stmt->execute();
?>
<section class="container mt-5">
  <div class="col mb-3">
    <h1><i class="ri-home-line"></i> Salas</h1>
    <span class="badge fs-6 ps-3 rounded-pill text-bg-primary bg-opacity text-white"><i
        class="ri-checkbox-circle-fill"></i> Livre</span>
    <span class="badge fs-6 ps-3 rounded-pill text-bg-danger bg-opacity text-white"><i class="ri-alert-line"></i>
      Reservada</span>
    <p class="fs-5 mt-3">Salas reservadas/não reservadas </p>
  </div>

  <?php
  # Mostrar uma mensagem caso a quantia de salas
  # for menor que 0, nesse caso, verificamos se 
  # a contagem de linhas é maior do que zero, caso a condição
  # seja verdadeira, exiba a lista
  if ($stmt->rowCount()):
    ?>
    <div class="col flex-wrap gap-3">
      <?php
      # Percorrer todos os itens da matriz
      # Verificar se a sala esta reservada com if(!$sala['reservado']) ? NAO RESERVADO(TRUE) : RESERVADO(FALSE)
      while ($salas = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
        <a href="
        <?php if (!$salas['reservado']): ?>
          <?= baseRedirect("reservas?nova-reserva=new&sala") ?>=<?= $salas['idsala'] ?>
        <?php else: ?>
          <?= baseRedirect("?action=confirm&sala") ?>=<?= $salas['idsala'] ?>
        <?php endif ?>" class="card justify-content-between align-items-center p-5 mb-3 fs-4 rounded text-decoration-none 
        <?php if (!$salas['reservado']): ?>
            bg-primary text-white bg-opacity-60
        <?php else: ?>
            bg-danger text-white bg-opacity-60
        <?php endif ?>">
          <?= $salas['nome'] ?>
        </a>
      <?php endwhile ?>
    </div>
  <?php else: ?>
    <div class="mb-3 border rounded p-3">
      <h1>Nenhuma sala foi adicionada</h1>
      <p class="text-gray">Para poder visualizar as salas, por favor, adicione uma no botão "+ Nova sala" ou clique aqui:
        <a href="<?= baseRedirect("salas?nova-sala=new") ?>">
          <i class="ri-add-fill"></i>
          Nova Sala
        </a>
      </p>
    </div>
  <?php endif ?>
</section>