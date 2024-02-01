<?php
$stmt_reserva = $pdo->prepare("SELECT * FROM usuarios");
$stmt_reserva->execute();
?>
<section class="container mt-3 mb-3">
  <div class="mb-3">
    <a href="?novo-usuario=new" class="btn btn-success">
      <i class="ri-add-fill"></i>
      Novo Usuario
    </a>
  </div>
  <h1> <i class="ri-user-line"></i> Usuários</h1>
  <?php
  if ($stmt_reserva->rowCount() > 0) {
  ?>
    <div class="d-flex flex-column gap-3 mt-4">
      <?php
      while ($usuario = $stmt_reserva->fetch(PDO::FETCH_ASSOC)) {
      ?>
        <div class="d-flex justify-content-between align-items-center p-3 border rounded">
          <div class="p-2 d-flex flex-column align-items-start">
            <h2>
              <i class="ri-user-line"></i> <?php echo $usuario["nome"] ?>
            </h2>
            <p class="text-body-tertiary">
              <i class="ri-pass-pending-line"></i> <?php echo $usuario["nregistro"] ?>
            </p>
          </div>
          <div>
            <a href="/usuarios?novo-usuario=edit&id=<?php echo $usuario["idusuario"] ?>" class="btn fs-4"><i class="ri-pencil-line"></i></a>
            <a href="/usuarios?action=delete-user&id=<?php echo $usuario["idusuario"] ?>" class="btn fs-4"><i class="ri-delete-bin-2-line"></i></a>
          </div>
        </div>
      <?php } ?>
    </div>
  <?php } else { ?>
    <div class="mb-3 border rounded p-3">
      <h1>Nenhum usuário foi adicionado</h1>
      <p class="text-gray">Para poder visualizar os usuários, por favor, adicione-o clicando no botão "+ Novo usuario" ou clique aqui:
        <a href="?novo-usuario=new">
          <i class="ri-add-fill"></i>
          Novo usuário
        </a>
      </p>
    </div>
  <?php } ?>
</section>