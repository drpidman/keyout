<?php include "config.php";
include "utils.php";
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keyout</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/fonts/remixicon.css">
    <link rel="stylesheet" href="./assets/css/css.css">
</head>

<body>
    <?php include_once "components/menu.php"; ?>

    <?php if (isset($_GET["action"]) && $_GET["action"] == "confirm") { include_once "./components/home/popup_confirmar.php"; } ?>

    <div class="container">
        <?php include_once "./components/home/table_home.php" ?>
    </div>
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
</body>
</html> 