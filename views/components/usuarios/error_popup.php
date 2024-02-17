<div class="modal d-block background-ofuscate position-fixed" tabindex="-1" id="m-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="ri-alert-line"></i>
                    Aviso
                </h5>
                <a type="button" class="btn-close" href="<?= $routes->getRoute("usuarios-page")->pathname ?>"></a>
            </div>
            <div class="modal-body">
                <?= $_GET["error"] ?>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-primary" href="<?= $routes->getRoute("usuarios-page")->pathname ?>">Fechar</a>
            </div>
        </div>
    </div>
</div>