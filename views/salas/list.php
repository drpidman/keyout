<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ASSETS_FOLDER . '/css/css.css' ?>">
    <link rel="stylesheet" href="<?= ASSETS_FOLDER . '/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" href="<?= ASSETS_FOLDER . '/fonts/remixicon.css' ?>">
    <title>Salas</title>
</head>

<body>
    <?php include_once "../views/components/navbar.php" ?>

    <div class="container">
        <?php include_once "../views/components/salas/list.php" ?>
    </div>

    <?php include_once "../views/components/footer.php" ?>
    <script src="<?= ASSETS_FOLDER . '/js/bootstrap.bundle.min.js' ?>"></script>
</body>

</html>