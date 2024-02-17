<section class="container mt-5">
    <div class="mb-5">
        <a href="<?= $routes->getRoute("usuarios-page")->pathname ?>" class="btn btn-primary rounded-pill">
            <i class="ri-arrow-left-wide-line"></i>
            Voltar
        </a>
    </div>
    <form class="rounded border p-3" method="POST" action="<?= $routes->getRoute("usuarios-page")->pathname ?>/<?= $user->idusuario ?>/edit">
        <div class="mb-3">
            <h1 class="form-floating-h1 border-start border-end">
                <i class="ri-survey-line"></i>
                Informações
            </h1>
            <section class="row flex-wrap gap-2 mb-3">
                <div class="col-sm-5">
                    <label class="form-label">Nome completo</label>
                    <input name="nome_usuario" type="text" value="<?= $user->nome ?>" class="form-control" id="nomeinput" aria-describedby="nomehelp" required>
                    <div id="nomehelp" class="form-text">Nome para identificação</div>
                </div>
                <div class="col-sm-6">
                    <label class="form-label">N. de registro</label>
                    <input name="nd_registro" type="text" value="<?= $user->nregistro ?>" class="form-control" id="nregistroinput" aria-describedby="nregistrohelp" required>
                    <div id="nregistrohelp" class="form-text">N. de registro, usado para identificação e para reservas</div>
                </div>
            </section>

            <?php if (isset($_GET["error"])) : ?>
                <span style="color: red"><?= $_GET["error"] ?></span>
            <?php endif ?>
        </div>

        <button type="submit" class="btn btn-primary rounded-pill" name="action" value="edit" formaction="<?= $routes->getRoute("usuarios-page")->pathname ?>/<?= $user->idusuario ?>/edit">
            <i class="ri-pencil-line"></i> Editar
        </button>
        <button type="button" class="btn btn-warning rounded-pill" data-bs-toggle="modal" data-bs-target="#delete-confirm-modal" name="action" value="delete">
            <i class="ri-delete-bin-2-line"></i> Excluir
        </button>

        <div class="modal fade" id="delete-confirm-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Deletar o usuário</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Deletar o usuário apagara todos os registros relacionados
                        ao mesmo, deseja confirmar a ação?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning" formaction="<?= $routes->getRoute("usuarios-page")->pathname ?>/<?= $user->idusuario ?>/delete">Confirmar</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
</section>