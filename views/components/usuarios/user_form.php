<section class="container mt-5">
    <div class="mb-5">
        <a href="<?= $routes->getRoute("usuarios-page")->pathname ?>" class="btn btn-primary rouded-pill">
            <i class="ri-arrow-left-wide-line"></i>
            Voltar
        </a>
    </div>
    <form class="rounded border p-3" method="POST" action="<?= $routes->getRoute("usuarios-new")->pathname ?>">
        <div class="mb-3">
            <h1 class="form-floating-h1 border-start border-end">
                <i class="ri-survey-line"></i>
                Novo Usuário
            </h1>
            <section class="row flex-wrap gap-2 mb-3">
                <div class="col-sm-5">
                    <label class="form-label">Nome completo</label>
                    <input name="nome_usuario" type="text" class="form-control" id="nomeinput" aria-describedby="nomehelp" required>
                    <div id="nomehelp" class="form-text">Nome para identificação</div>
                </div>
                <div class="col-sm-6">
                    <label class="form-label">N. de registro</label>
                    <input name="nd_registro" type="text" class="form-control" id="nregistroinput" aria-describedby="nregistrohelp" required>
                    <div id="nregistrohelp" class="form-text">N. de registro, usado para identificação e para reservas</div>
                </div>
            </section>
            <?php if (isset($_GET["error"])) : ?>
                <span style="color: red"><?= $_GET["error"] ?></span>
            <?php endif ?>
        </div>
        <button type="submit" class="btn btn-primary rounded-pill">
            <i class="ri-checkbox-circle-line"></i>
            Confirmar
        </button>
    </form>
</section>