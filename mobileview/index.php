<?php
include "../config.php";
include "../utils.php";
?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keyout</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fonts/remixicon.css">
    <link rel="stylesheet" href="../assets/css/css.css">
</head>

<body>
    <?php if (isset($_GET["erro"])) include_once "../components/mobileview/popup_error.php" ?>
    
    <div class="container">
        <?php include_once "../components/mobileview/table_mobilevew.php" ?>
    </div>
    
    <?php include_once "../components/mobileview/footer.php" ?>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>