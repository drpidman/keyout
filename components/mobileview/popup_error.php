<div class="modal d-block background-ofuscate position-fixed" tabindex="-1" id="m-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="ri-alert-line"></i>
                    Aviso
                </h5>
                <?php if ($_GET["erro"] == "user_not_found"): ?>
                    <a type="button" class="btn-close" href="<?= baseRedirect("mobileview") ?>"></a>
                <?php endif ?>
            </div>
            <div class="modal-body">
                <?php if ($_GET["erro"] == "user_not_found"): ?>
                    <p>Nenhum usuário foi econtrado com esse numero de registro.
                        Verifique suas credenciais e tente novamente
                    </p>
                <?php endif ?>

                <?php if ($_GET["erro"] == "empty_sala"): ?>
                    <p>Nenhuma sala foi selecionada, por favor, selecione uma!</p>
                <?php endif ?>
            </div>
            <div class="modal-footer">
                <?php if ($_GET["erro"] == "user_not_found"): ?>
                    <a type="button" class="btn btn-primary" href="<?= baseRedirect("mobileview") ?>">Fechar</a>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>