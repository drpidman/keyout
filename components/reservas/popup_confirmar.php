<?php
$stmt = $pdo->prepare("SELECT * FROM salas");
$stmt->execute();
?>
<div class="modal d-block background-ofuscate position-fixed" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar devolução</h5>
                <a type="button" class="btn-close" href="/reservas"></a>
            </div>
            <?php if (isset($_GET["method"]) && $_GET["method"] == "search") : ?>
                <form class="modal-body" action="/reservas/actions.php?action=get_reserved" method="POST">
                    <div class="mb-3">
                        <label for="input_nregistro" class="form-label">Numero de registro</label>
                        <input type="text" class="form-control" id="input_nregistro" name="nregistro" aria-describedby="nregistro_help">
                        <div id="nregistro_help" class="form-text">
                            Digite seu numero de registro para buscar as salas reservadas
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit">Buscar salas</button>
                    </div>
                </form>
            <?php endif; ?>
            <?php if (isset($_GET["method"]) && $_GET["method"] == "change_status") :
                $user_id = $_GET["user_id"];

                $query_reservas = $pdo->prepare(
                    "SELECT DISTINCT sls.nome AS roomname, sls.idsala FROM reservas
                     INNER JOIN salas sls ON reservas.idsala = sls.idsala
                     WHERE idusuario = :idusuario AND sls.reservado = true AND atualizadoEm IS NULL
                     "
                );

                $query_reservas->bindParam(":idusuario", $user_id);
                $query_reservas->execute();
            ?>
                <?php if ($query_reservas->rowCount()) : ?>
                    <form class="modal-body" action="/reservas/actions.php?action=confirm&redirect=/reservas" method="POST">
                        <input type="hidden" value="<?= $user_id ?>" name="user_id">
                        <select class="form-select" aria-label="Sala selector" id="select_sala" name="select_sala" required>
                            <option selected>Selecione uma sala</option>
                            <?php while ($usuario = $query_reservas->fetch(PDO::FETCH_ASSOC)) : ?>
                                <option value="<?= $usuario["idsala"] ?>"><?= $usuario["roomname"] ?></option>
                            <?php endwhile ?>
                        </select>
                        <div id="select_sala" class="form-text mb-3 mt-3">
                            Selecione a sala que deseja confirmar a devolução
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" type="submit">Confirmar</button>
                        </div>
                    </form>
                <?php else : ?>
                    <div class="modal-body">
                        <p>Nenhuma sala reservada foi econtrada para o seu usuário</p>
                    </div>
                    <div class="modal-footer">
                        <a href="/reservas" class="btn btn-success">Fechar</a>
                    </div>
                <?php endif ?>
            <?php endif; ?>
            <?php if (isset($_GET["method"]) && $_GET["method"] == "confirm") :
                $reserva_id = $_GET["reserva"];
                $query_reservas = $pdo->prepare(
                    "SELECT * FROM reservas WHERE idreserva = :idreserva"
                );
                $query_reservas->bindParam(":idreserva", $reserva_id);
                $query_reservas->execute();
                $reserva = $query_reservas->fetch(PDO::FETCH_OBJ);
            ?>
                <form class="modal-body" action="/reservas/actions.php?action=confirm&redirect=/reservas" method="POST">
                    <input type="hidden" value="<?= $reserva->idusuario ?>" name="user_id">
                    <input type="hidden" value="<?= $reserva->idsala ?>" name="select_sala">
                    <div class="mb-3">
                        <p>Deseja confirmar a devolução?</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit">Confirmar</button>
                    </div>
                </form>
            <?php endif ?>
        </div>
    </div>
</div>