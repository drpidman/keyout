<?php
$stmt = $pdo->prepare("SELECT * FROM salas WHERE listagem = 'ativa' ORDER BY nome");
$stmt->execute();
?>
<section class="container mt-3">
  <div class="mb-3">
    <a href="?nova-sala=new" class="btn btn-success">
      <i class="ri-add-fill"></i>
      Nova Sala
    </a>
  </div>
  <h1><i class="ri-home-line"></i> Salas</h1>
  <?php
  if ($stmt->rowCount()) :
  ?>
    <div class="d-flex flex-column gap-3 mt-4">
      <?php while ($usuario = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
        <div class="d-flex justify-content-between align-items-center p-3 border rounded">
          <div class="">
            <?= $usuario['nome'] ?>
          </div>
          <div>
            <a href="<?= baseRedirect("salas?nova-sala=edit") ?>&id=<?= $usuario['idsala'] ?>" class="btn fs-4 rounded"><i class="ri-pencil-line"></i></a>
            <a href="<?= baseRedirect("salas?action=delete-sala") ?>&id=<?= $usuario['idsala'] ?>" class="btn fs-4 rounded"><i class="ri-delete-bin-2-line"></i></a>
          </div>
        </div>
      <?php endwhile ?>
    </div>
  <?php else : ?>
    <div class="mb-3 border rounded p-3">
      <h1>Nenhuma sala foi adicionada</h1>
      <p class="text-gray">Para poder visualizar as salas, por favor, adicione uma no botão "+ Nova sala" ou clique aqui:
        <a href="?nova-sala=new">
          <i class="ri-add-fill"></i>
          Nova Sala
        </a>
      </p>
    </div>
  <?php endif ?>
</section>