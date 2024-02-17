<div class="modal fade" id="delete-confirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="ri-lock-line"></i> Apagar sala</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="modal-body" action="<?= $routes->getRoute("salas-page")->pathname ?>/<?= $routes->getRoute("salas-edit-page")->params[0] ?>/delete" method="POST">
                <input type="hidden" name="sala_id" value="<?= $routes->getRoute("salas-edit-page")->params[0] ?>">  
                <div class="col-sm mt-2">
                    <p>
                        <i class="ri-information-line text-primary"></i>
                        Deletar uma sala apagará todos os registros relacionados a mesma. Deseja confirmar?
                    </p>
                </div>
                <div class="modal-footer mt-3">
                    <button type="submit" class="btn btn-danger"><i class="ri-check-line"></i> Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>