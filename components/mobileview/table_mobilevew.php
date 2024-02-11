<?php
/**
 * Pre-query para carregar as salas ao carregar o componente sala
 */
$stmt = $pdo->prepare("SELECT * FROM salas WHERE listagem = 'ativa'");
$stmt->execute();
?>
<section class="container mt-5">
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

        <?php include "popup_res.php" ?>
        <?php include "popup_confirm.php" ?>

        <a data-bs-toggle="modal" data-bs-target="<?php if (!$salas['reservado'])
          echo "#modal-res-" . $salas["idsala"];
        else
          echo "#modal-confirm-" . $salas["idsala"] ?>" type="button" class="card justify-content-between align-items-center p-5 mb-3 fs-4 rounded text-decoration-none
        <?php if (!$salas['reservado']): ?>
            text-white bg-primary
        <?php else: ?>
            text-white bg-danger
        <?php endif ?>">
          <?= $salas['nome'] ?>
        </a>

      <?php endwhile ?>
      <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Launch demo modal
          </button> 
        -->
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