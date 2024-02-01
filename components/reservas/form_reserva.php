<?php
$query_salas = $pdo->prepare("SELECT * FROM salas WHERE reservado != true ORDER BY nome");
$query_salas->execute();

$sala_from_home = null;
if (isset($_GET["sala"])) {
  $query_sala = $pdo->prepare("SELECT * FROM salas WHERE idsala = :id");
  $query_sala->bindParam(":id", $_GET["sala"]);
  $query_sala->execute();

  $sala_from_home = $query_sala->fetch(PDO::FETCH_ASSOC);
}
?>
<section class="container mt-5">
  <div class="mb-3">
    <a href="
    <?php 
      if ($sala_from_home) {
        echo "/";
      } else {
        echo "/reservas";
      } ?> " class="btn btn-success">
      <i class="ri-arrow-left-wide-line"></i>
      Voltar
    </a>
  </div>
  <!-- FORM START -->
  <form class="rounded border p-3 mt-5" method="POST" action="/reservas/actions.php?action=new">
    <div class="mb-3">
      <h1 class="form-floating-h1 border-start border-end">
        <i class="ri-survey-line"></i>
        Nova reserva
      </h1>
      <!-- SECTION 1 -->
      <p>Campos com <span class="text-danger">"*"</span> são obrigatórios</p>
      <section class="row flex-wrap mb-3">
        <!-- DIV INPUT N.REGISTRO  -->
        <div class="col-sm-5">
          <label class="form-label">N. de Registro <span class="text-danger">*</span></label>
          <input type="text" class="form-control" id="input_nregistro" aria-describedby="nregistro_help" name="nregistro" required>
          <div id="nregistro_help" class="form-text">N. de Registro para indenticação</div>
        </div>
        <!-- END DIV INPUT N.REGISTRO -->
        <!-- DIV SELECT SALAS -->
        <div class="col-sm-5 col-md-3">
          <label class="form-label">Salas <span class="text-danger">*</span></label>
          <select class="form-select" aria-label="Seletor de salas" aria-describedby="select_salas_help" name="select_sala" required>
            <option 
            <?php if (!$sala_from_home) { echo "selected"; } ?> value="0">Nenhuma sala selecionada</option>
            <?php
            # seleção de salas disponiveis para reserva
            while ($usuario = $query_salas->fetch(PDO::FETCH_ASSOC)) { ?>
              <option value="<?php echo $usuario["idsala"] ?>"
              <?php
              # verificar se a sala foi selecionada pela pagina "home", se sim, selecionar a opção marcada
              # caso não, apenas deixar como seleção padrão "Nenhuma sala foi selecionada"
              if ($sala_from_home && $usuario["idsala"] == $sala_from_home["idsala"]) { echo "selected"; }?>
              >
              <?php echo $usuario["nome"]?>
              </option>
            <?php
            }
            ?>
          </select>
          <div id="select_salas_help" class="form-text">Selecione uma sala para reservar. <br> Apenas salas não reservadas são mostradas</div>
        </div>
        <!-- END DIV SELECT SALAS -->
      </section>
      <?php if (isset($_GET["erro"]) && $_GET["erro"] == "empty_periodo" || isset($_GET["erro"]) && $_GET["erro"] == "empty_sala") { ?>
        <span class="text-danger">Por favor, preencha todos os campos necessários</span>
      <?php } ?>
    </div>
    <button type="submit" class="btn btn-primary">Reservar</button>
  </form>
  <!-- FORM END -->
</section>