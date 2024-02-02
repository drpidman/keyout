<?php
$sala_id = $_GET["id"];

$stmt = $pdo->prepare("SELECT * FROM salas WHERE idsala = :idsala");
$stmt->bindParam(":idsala", $sala_id);
$stmt->execute();

$sala = $stmt->fetch(PDO::FETCH_OBJ);

?>
<div class="modal d-block background-ofuscate position-fixed" tabindex="-1" id="m-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="ri-alert-line"></i>
                    Aviso
                </h5>
                <a type="button" class="btn-close" href="/salas"></a>
            </div>
            <form class="modal-body" action="/salas/actions.php?action=delete" method="POST">
                <input type="hidden" value="<?= $sala->idsala ?>" name="idsala">
                <p>Deletar a sala apagará todos os registros de reservas
                    relacionados a mesma.
                </p>
                <button class="btn btn-danger" type="submit">Confirmar</button>
            </form>
        </div>
    </div>
</div>