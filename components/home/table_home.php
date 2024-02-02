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
    <span class="badge fs-6 ps-3 rounded-pill text-bg-success bg-opacity-50 text-dark"><i class="ri-checkbox-circle-fill"></i> Livre</span>
    <span class="badge fs-6 ps-3 rounded-pill text-bg-danger bg-opacity-50 text-dark"><i class="ri-alert-line"></i> Reservada</span>
    <p class="fs-5 mt-3">Salas reservadas/não reservadas </p>
  </div>


  <?php
  # Mostrar uma mensagem caso a quantia de salas
  # for menor que 0, nesse caso, verificamos se 
  # a contagem de linhas é maior do que zero, caso a condição
  # seja verdadeira, exiba a lista
  if ($stmt->rowCount() > 0) :
  ?>
    <div class="col flex-wrap gap-3">
      <?php
      # Percorrer todos os itens da matriz
      # Verificar se a sala esta reservada com if(!$sala['reservado']) ? NAO RESERVADO(TRUE) : RESERVADO(FALSE)
      while ($usuario = $stmt->fetch(PDO::FETCH_ASSOC)) :
      ?>
        <?php if (!$usuario['reservado']) : ?>
          <a href="/reservas?nova-reserva=new&sala=<?= $usuario['idsala'] ?>" class="card justify-content-between align-items-center p-5 mb-3 rounded text-decoration-none bg-success-subtle">
            <div class="p-3 text-body fs-4">
              <?= $usuario['nome'] ?>
            </div>
          </a>
        <?php else : ?>
          <a href="reserva?action=confirm&sala=<?= $usuario["idsala"] ?>" class="card d-flex justify-content-between align-items-center p-5 mb-3 rounded text-decoration-none bg-danger-subtle">
            <div class="p-3 text-body fs-4">
              <?= $usuario['nome'] ?>
            </div>
          </a>
        <?php endif ?>
      <?php endwhile ?>
    </div>
  <?php else : ?>
    <div class="mb-3 border rounded p-3">
      <h1>Nenhuma sala foi adicionada</h1>
      <p class="text-gray">Para poder visualizar as salas, por favor, adicione uma no botão "+ Nova sala" ou clique aqui:
        <a href="/salas?nova-sala=new">
          <i class="ri-add-fill"></i>
          Nova Sala
        </a>
      </p>
    </div>
  <?php endif ?>
</section>