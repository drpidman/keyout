<section class="container mt-3 mb-3">
    <div class="mb-3">
        <a href="<?= $routes->getRoute("salas-new-page")->pathname ?>" class="btn btn-primary">
            <i class="ri-add-fill"></i>
            Novo Sala
        </a>
    </div>
    <?php if (sizeof($salas) <= 0) : ?>
        <div class="alert alert-warning mt-4 shadow-sm">
            <h1 class="m-0 alert-heading">
                <i class="ri-timer-line"></i>
                Ops... parece que nenhuma sala foi criada
            </h1>
            <hr>
            <p class="fs-5">
                Aguarde... algumas delas ainda podem aparecer ou você pode tentar recarregar a página. Caso veja
                que as salas já foram adicionadas e nao apareceram, reporte um problema!
            </p>
            <hr>
            <span><a href="" class="text-decoration-none" style="color: var(--bs-alert-link-color)">Reportar um problema</a></span>
        </div>
    <?php return;
    endif ?>
    <hr>
    <h1><i class="ri-door-open-line"></i> Salas</h1>
    <p class="text-muted fs-5"><i class="ri-info-i text-white bg-primary rounded-pill"></i> - Para ver mais detalhes sobre a sala ou editar, clique nos cards.</p>
    <hr>

    <div class="d-flex flex-column mt-4 text-decoration-none text-dark rounded">
        <?php foreach ($salas as $sala) : ?>
            <?php include __DIR__ . "/list/modal_edition.php" ?>
            <?php include __DIR__ . "/list/sala_item.php" ?>
        <?php endforeach ?>
    </div>
</section>