<?php
$idsala = $_GET["sala"];

$stmt = $pdo->prepare("SELECT * FROM reservas WHERE idsala = :idsala AND atualizadoEm IS NULL");
$stmt->bindParam(":idsala", $idsala);
$stmt->execute();
$reserva = $stmt->fetch(PDO::FETCH_OBJ);

?>
<div class="modal d-block background-ofuscate position-fixed" tabindex="-1" id="m-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="ri-contract-right-line"></i> Confirmar devolução</h5>
                <a type="button" class="btn-close" href="<?= baseRedirect("") ?>"></a>
            </div>
            <form class="modal-body"
                action="<?= baseRedirect("reservas/actions.php?action=confirm") ?>&redirect=<?= baseRedirect("") ?>"
                method="POST">
                <input type="hidden" value="<?= $reserva->idusuario ?>" name="user_id">
                <input type="hidden" value="<?= $reserva->idsala ?>" name="select_sala">
                <p>Para confirmar, apenas pressione o botão abaixo</p>
                <button class="btn btn-primary" type="submit">
                    Confirmar
                </button>
            </form>
        </div>
    </div>
</div>