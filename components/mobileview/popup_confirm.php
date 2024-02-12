<div class="modal fade" tabindex="-1" id="modal-confirm-<?= $salas["idsala"] ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="ri-contract-right-line"></i> Confirmar devolução</h5>
                <a type="button" class="btn-close" href="<?= baseRedirect("mobileview") ?>"></a>
            </div>
            <form class="modal-body"
                action="<?= baseRedirect("reservas/actions.php?action=confirm_sala&redirect=") . baseRedirect("mobileview") ?>"
                method="POST">
                <input type="hidden" value="<?= $salas['idsala'] ?>" name="select_sala">
                <p>Para confirmar, apenas pressione o botão abaixo</p>
                <button class="btn btn-primary" type="submit"><i class="ri-checkbox-circle-line"></i> Confirmar</button>
            </form>
        </div>
    </div>
</div>