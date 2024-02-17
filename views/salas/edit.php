<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ASSETS_FOLDER . '/css/css.css' ?>">
    <link rel="stylesheet" href="<?= ASSETS_FOLDER . '/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" href="<?= ASSETS_FOLDER . '/fonts/remixicon.css' ?>">
    <title>Salas - Editar - <?= $sala->nome ?></title>
</head>

<body>
    <?php include_once "../views/components/navbar.php" ?>
    <?php include_once "../views/components/salas/sala_info/modal_delete.php" ?>
    <div class="container">
        <?php include_once "../views/components/salas/sala_info.php" ?>
    </div>
    <?php include_once "../views/components/footer.php" ?>
    <script src="<?= ASSETS_FOLDER . '/js/bootstrap.bundle.min.js' ?>"></script>
</body>

</html>