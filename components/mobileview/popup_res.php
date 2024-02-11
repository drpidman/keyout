<div class="modal fade" id="modal-res-<?= $salas["idsala"] ?>" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Reservar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="modal-body"
                action="<?= baseRedirect("reservas/actions.php?action=new&mb_redirect=") . baseRedirect("mobileview") ?>"
                method="POST">
                <div class="mb-3">
                    <input type="hidden" value="<?= $salas['idsala'] ?>" name="select_sala">
                    <label for="nregistroinput" class="form-label">N.Registro</label>
                    <input type="text" class="form-control" id="nregistroinput" aria-describedby="nregistrohelp"
                        name="nregistro">
                    <div id="nregistrohelp" class="form-text">Numero de registro para identificação</div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Pegar chave</button>
                </div>
            </form>
        </div>
    </div>
</div>