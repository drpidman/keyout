<div class="modal fade" id="authorize-edition-for-<?= $usuario["idusuario"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="ri-lock-line"></i> Editar usuário</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="modal-body" action="<?= $routes->getRoute("usuarios-edit-unlock")->pathname ?>" method="POST">
                <i class="ri-information-line text-primary"></i> Para editar o usuário, você precisa fornecer seu número de registro válido por questões de segurança
                <div class="col-sm mt-2">
                    <label class="form-label">Número de registro</label>
                    <input type="hidden" name="user_id" value="<?= $usuario["idusuario"] ?>">
                    <input name="nd_registro" type="text" class="form-control" id="nregistroinput" aria-describedby="nregistrohelp" required>
                    <div id="nregistrohelp" class="form-text">N. de registro, usado para identificação e para reservas</div>
                </div>
                <div class="modal-footer mt-3">
                    <button type="submit" class="btn btn-warning"><i class="ri-lock-unlock-line"></i> Desbloquear</button>
                </div>
            </form>
        </div>
    </div>
</div>