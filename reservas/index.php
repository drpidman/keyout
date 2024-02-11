<?php
include "../config.php";
include "../utils.php";
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keyout - Reservas</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fonts/remixicon.css">
    <link rel="stylesheet" href="../assets/css/css.css">
</head>

<body>
    <?php include_once "../components/menu.php"; ?>
    <div class="container-fluid mt-3">
        <h1>Controle de Reservas</h1>
        <hr>

        <?php if (isset($_GET["erro"])) include_once "../components/reservas/popup_error.php"; ?>

        <?php if (isset($_GET["action"]) && $_GET["action"] == "confirmar")
            include_once "../components/reservas/popup_confirmar.php"; ?>

        <?php if (isset($_GET["nova-reserva"]) && $_GET["nova-reserva"] == "new")
            include_once "../components/reservas/form_reserva.php"; ?>

        <?php if (!isset($_GET["nova-reserva"]))
            include_once "../components/reservas/table_reservas.php" ?>
    </div>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>