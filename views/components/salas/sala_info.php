<section class="container mt-5">
    <div class="mb-3">
        <a href="<?= $routes->getRoute("salas-page")->pathname ?>" class="btn btn-primary rounded-pill">
            <i class="ri-arrow-left-wide-line"></i>
            Voltar
        </a>
    </div>
    <form class="rounded border p-3 mt-5" method="POST" action="<?= $routes->getRoute("salas-page")->pathname ?>/<?= $sala->idsala ?>/edit">
        <div class="mb-3">
            <h1 class="form-floating-h1 border-start border-end">
                <i class="ri-survey-line"></i>
                Editar sala
            </h1>
            <section class="row gap-5 mb-3">
                <input name="id" type="hidden" value="<?= $sala->idsala ?>">
                <div class="col-sm-6">
                    <label class="form-label">Nome da sala</label>
                    <input type="text" name="nome_sala" value="<?= $sala->nome ?>" class="form-control" id="sala-input" aria-describedby="sala_help" required>

                    <div id="sala_help" class="form-text">Um nome para identificar a sala</div>
                </div>
            </section>
        </div>
        <button type="submit" class="btn btn-primary rounded-pill">
            <i class="ri-save-line"></i>
            Salvar
        </button>
        <button type="button" class="btn btn-danger rounded-pill" data-bs-toggle="modal" data-bs-target="#delete-confirm">
            <i class="ri-delete-bin-line"></i>
            Deletar
        </button>
    </form>
    <div class="alert alert-primary d-flex align-items-center mt-3" role="alert">
        <div>
            <i class="ri-information-2-line"></i> Editando como usuário: <?= $user->nome ?>
        </div>
    </div>
</section>