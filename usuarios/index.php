<?php
include "../config.php";
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keyout - Usuarios</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/remixicon.css">
    <link rel="stylesheet" href="assets/css/css.css">
</head>

<body>
    <?php include_once "../components/menu.php"; ?>

    <div class="container-fluid mt-3">
        <h1>Controle de Usuarios</h1>
        <hr>
        <?php if (isset($_GET["action"]) && $_GET["action"] == "delete-user") {
            include_once "../components/usuarios/popup_delete_confirmar.php";
        } ?>

        <?php if (
            isset($_GET['novo-usuario']) && $_GET['novo-usuario'] == "new"
            || isset($_GET["novo-usuario"]) && $_GET["novo-usuario"] == "edit"
        ) include_once "../components/usuarios/form_usuario.php"; ?>
        <?php if (!isset($_GET['novo-usuario']))  include_once "../components/usuarios/table_usuarios.php" ?>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>