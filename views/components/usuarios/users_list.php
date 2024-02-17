<section class="container mt-3 mb-3">
    <div class="mb-3">
        <a href="<?= $routes->getRoute("usuarios-new-page")->pathname ?>" class="btn btn-primary">
            <i class="ri-add-fill"></i>
            Novo Usuario
        </a>
    </div>
    <?php if (sizeof($users) <= 0) : ?>
        <div class="alert alert-warning mt-4 shadow-sm">
            <h1 class="m-0 alert-heading">
                <i class="ri-timer-line"></i>
                Ops... parece que nenhum usuário foi criado
            </h1>
            <hr>
            <p class="fs-5">
                Aguarde... alguns deles ainda podem aparecer ou você pode tentar recarregar a página. Caso veja
                que usuários já tentaram se cadastrar e nao apareceram, reporte um problema!
            </p>
            <hr>
            <span><a href="" class="text-decoration-none" style="color: var(--bs-alert-link-color)">Reportar um problema</a></span>
        </div>
    <?php else : ?>
        <hr>
        <h1> <i class="ri-user-line"></i> Usuários</h1>
        <p class="text-muted fs-5"><i class="ri-info-i text-white bg-primary rounded-pill"></i> - Para ver mais detalhes sobre o usuário ou editar, clique nos cards.</p>
        <hr>
        <div class="d-flex flex-column mt-4 text-decoration-none text-dark rounded">
            <?php foreach ($users as $usuario) : ?>
                <?php include __DIR__ . "/list/modal_edition.php" ?>
                <?php include __DIR__ . "/list/user_item.php" ?>
            <?php endforeach ?>
        </div>
    <?php endif ?>
</section>