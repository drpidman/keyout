<?php
$sala_id = $_GET["id"];

$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE idusuario = :idusuario");
$stmt->bindParam(":idusuario", $sala_id);
$stmt->execute();

$usuario = $stmt->fetch(PDO::FETCH_OBJ);

?>
<div class="modal d-block background-ofuscate position-fixed" tabindex="-1" id="m-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="ri-alert-line"></i>
                    Aviso
                </h5>
                <a type="button" class="btn-close" href="/usuarios"></a>
            </div>
            <form class="modal-body" action="/usuarios/actions.php?action=delete" method="POST">
                <input type="hidden" value="<?= $usuario->idusuario ?>" name="user_id">
                <p>Deletar o usuário apagará todos os registros de reservas
                    relacionados ao mesmo. Garanta que o usuário não possua reservas pendentes,
                    pois qualquer estado será apagado.
                </p>
                <button class="btn btn-danger" type="submit">Confirmar</button>
            </form>
        </div>
    </div>
</div>