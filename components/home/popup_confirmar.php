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
                <h5 class="modal-title">Confirmar devolução</h5>
                <a type="button" class="btn-close" href="/"></a>
            </div>
            <form class="modal-body" action="/reservas/actions.php?action=confirm&redirect=/" method="POST">
                <input type="hidden" value="<?php echo $reserva->idusuario ?>" name="user_id">
                <input type="hidden" value="<?php echo $reserva->idsala ?>" name="select_sala">
                <p>Para confirmar, apenas pressione o botão abaixo</p>
                <button class="btn btn-success" type="submit">Confirmar</button>
            </form>
        </div>
    </div>
</div>