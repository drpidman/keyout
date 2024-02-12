<?php
include "../config.php";
include "../utils.php";
?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keyout - Sistema</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fonts/remixicon.css">
    <link rel="stylesheet" href="../assets/css/css.css">
</head>

<body>

    <?php if (!isset($_GET["filter"])): ?>
        <div class="page-wrap d-flex flex-row align-items-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12 text-center">
                        <span class="display-1 d-block">404</span>
                        <div class="mb-4 lead">Ops, parece que não existe nenhuma página aqui.....</div>
                        <a href="<?= baseRedirect("") ?>" class="btn btn-link">Voltar para principal</a>
                    </div>
                </div>
            </div>
        </div>
        <?php header("HTTP/1.1 404 Not FOund"); ?>
        <?php return; ?>
    <?php endif ?>

    <?php include_once "../components/menu.php"; ?>

    <div class="container mt-4">
        <?php if ($_GET["filter"] && $_GET["filter"] == "sugestoes"): ?>
            <h1>Sugestões</h1>
            <?php
            $stmt = $pdo->prepare("SELECT * FROM systemreports WHERE type = 'sugestao' ORDER BY idreport DESC");
            $stmt->execute();
            ?>

            <?php if (!$stmt->rowCount()): ?>
                <div class="mb-3 border rounded p-3 mt-3">
                    <h1>
                        <i class="ri-puzzle-line"></i>
                        Nada por aqui...
                    </h1>
                    <p class="text-gray">Aguarde....
                    </p>
                </div>
            <?php endif ?>

            <div class="mt-4">
                <?php while ($sugestao = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">
                            <i class="ri-puzzle-line"></i>
                            <?= $sugestao["nome"] ?>
                        </h4>
                        <p>
                            <?= $sugestao["descricao"] ?>
                        </p>
                        <hr>
                        <p class="mb-0">
                            <i class="ri-pages-line"></i> Da pagina:
                            <?= $sugestao["from_page"] ?>
                        </p>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif ?>

        <?php if ($_GET["filter"] && $_GET["filter"] == "problemas"): ?>
            <h1>Problemas</h1>
            <?php
            $stmt = $pdo->prepare("SELECT * FROM systemreports WHERE type = 'problema' ORDER BY idreport DESC");
            $stmt->execute();
            ?>

            <?php if (!$stmt->rowCount()): ?>
                <div class="mb-3 border rounded p-3 mt-3">
                    <h1>
                        <i class="ri-bug-line"></i>
                        Nada por aqui...
                    </h1>
                    <p class="text-gray">Aguarde....
                    </p>
                </div>
            <?php endif ?>

            <div class="mt-4">
                <?php while ($problema = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">
                            <i class="ri-bug-line"></i>
                            <?= $problema["nome"] ?>
                        </h4>
                        <p>
                            <?= $problema["descricao"] ?>
                        </p>
                        <hr>
                        <p class="mb-0">
                            <i class="ri-pages-line"></i> Da pagina:
                            <?= $problema["from_page"] ?>
                        </p>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif ?>
    </div>

    <?php include_once "../components/footer.php" ?>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>