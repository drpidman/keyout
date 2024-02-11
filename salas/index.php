<?php
include "../config.php";
include "../utils.php";
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keyout - Salas</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fonts/remixicon.css">
    <link rel="stylesheet" href="../assets/css/css.css">
</head>

<body>
    <?php include_once "../components/menu.php"; ?>

    <div class="container-fluid mt-3">
        <h1>Controle de Salas</h1>
        <hr>

        <?php if (isset($_GET["action"]) && $_GET["action"] == "delete-sala")
            include_once "../components/salas/popup_delete_confirmar.php";
        ?>

        <?php
        if (
            isset($_GET['nova-sala']) && $_GET['nova-sala'] == "new"
            || isset($_GET['nova-sala']) && $_GET['nova-sala'] == "edit"
        ) include_once "../components/salas/form_sala.php";
        ?>
        <?php if (!isset($_GET['nova-sala'])) include_once "../components/salas/table_salas.php" ?>
    </div>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>