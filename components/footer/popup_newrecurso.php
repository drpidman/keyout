<div class="modal fade" id="modal-novo-recurso" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="ri-puzzle-line"></i> Sugerir recurso</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="modal-body" method="POST"
                action="<?= baseRedirect("sistema/actions.php?action=sugestion_new") ?>">
                <div class="mb-3">
                    <label for="username" class="form-label">Seu nome</label>
                    <input type="text" class="form-control" id="username" name="username" aria-describedby="nomehelp"
                        required>
                    <div id="nomehelp" class="form-text"></div>
                </div>
                <div class="mb-3">
                    <label for="inputsug" class="form-label">Sugestão</label>
                    <textarea type="text" class="form-control" id="inputsug" name="sugestext" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>