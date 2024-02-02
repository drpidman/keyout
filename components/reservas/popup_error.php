<div class="modal d-block background-ofuscate position-fixed" tabindex="-1" id="m-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="ri-alert-line"></i>
                    Aviso
                </h5>
                <?php if (isset($_GET["from_page"]) && $_GET["from_page"] == "change_status") { ?>
                    <a type="button" class="btn-close" href="/reservas?action=confirmar&method=change_status&user_id=<?php echo $_GET["user_id"]?>"></a>
                <?php } ?>

                <?php if (isset($_GET["from_page"]) && $_GET["from_page"] == "search") { ?>
                    <a type="button" class="btn-close" href="/reservas?action=confirmar&method=search"></a>
                <?php } ?>

                <?php if (isset($_GET["sala"])) { ?>
                    <a type="button" class="btn-close" href="/reservas?nova-reserva=new<?php if (isset($_GET["sala"])) echo "&sala=" . $_GET["sala"] ?>"></a>
                <?php } ?>

                <?php if ($_GET["erro"] == "empty_sala") { ?>
                    <a type="button" class="btn-close" href="/reservas?nova-reserva=new"></a>
                <?php } ?>
            </div>
            <div class="modal-body">
                <?php if ($_GET["erro"] == "user_not_found") { ?>
                    <p>Nenhum usuário foi econtrado com esse numero de registro.
                        Verifique suas credenciais e tente novamente
                    </p>
                <?php } ?>
                
                <?php if ($_GET["erro"] == "empty_sala") { ?>
                    <p>Nenhuma sala foi selecionada, por favor, selecione uma!</p>
                <?php } ?>
            </div>
            <div class="modal-footer">
                <?php if (isset($_GET["from_page"]) && $_GET["from_page"] == "change_status") { ?>
                    <a type="button" class="btn btn-primary" href="/reservas?action=confirmar&method=change_status&user_id=<?php echo $_GET["user_id"] ?>">Fechar</a>
                <?php } ?>

                <?php if (isset($_GET["from_page"]) && $_GET["from_page"] == "search") { ?>
                    <a type="button" class="btn btn-primary" href="/reservas?action=confirmar&method=search">Fechar</a>
                <?php } ?>

                <?php if (isset($_GET["sala"])) { ?>
                    <a type="button" class="btn btn-primary" href="/reservas?nova-reserva=new<?php if (isset($_GET["sala"])) echo "&sala=" . $_GET["sala"] ?>">Fechar</a>
                <?php } ?>
                
                <?php if ($_GET["erro"] == "empty_sala") { ?>
                    <a type="button" class="btn btn-primary" href="/reservas?nova-reserva=new">Fechar</a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>