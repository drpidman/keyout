<section class="container mt-4">
    <div class="mb-3">
        <section class="mb-3">
            <a href="?nova-reserva=new" class="btn btn-primary">
                <i class="ri-add-fill"></i>
                Nova Reserva
            </a>
            <a href="?action=confirmar&method=search" class="btn btn-warning">
                <i class="ri-arrow-go-back-line"></i>
                Devolução
            </a>
        </section>
        <hr>
        <section class="mb-3">
            <h1><i class="ri-key-2-line"></i> Reservas</h1>
            <span class="badge fs-6 ps-3 rounded-pill text-bg-primary bg-opacity-10 border border-secondary text-dark"><i class="ri-checkbox-circle-fill"></i>
                Completa</span>
            <span class="badge fs-6 ps-3 rounded-pill text-bg-warning bg-opacity text-dark"><i class="ri-alert-line"></i>
                Pendente</span>
        </section>
        <hr>
    </div>
    <form class="search-box mb-3">
        <i class="ri-search-2-line ms-2"></i>
        <input name="search" type="text" class="form-control ms-3 mx-3" value="<?= isset($_GET["search"]) ? $_GET["search"] : "" ?>" placeholder="Buscar reserva, salas ou usuários">
        <button type="submit" class="btn btn-primary rounded"><i class="ri-search-2-line"></i></button>
    </form>
    <div class="accordion accordion-flush" id="accordion-reserva">
        <?php foreach ($reservas as $reserva) : ?>
            <?php include __DIR__ . "/list/reserva_item.php" ?>
        <?php endforeach ?>
    </div>
</section>