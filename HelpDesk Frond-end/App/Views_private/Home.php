<?php
session_start();

if (!isset($_SESSION['email']) && !isset($_SESSION['setor'])) {
    header('location: ../../Index.php?Login=ERROR');
}


?>
<form action="">

</form>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Help Desk │ <?php echo $_SESSION['setor'] ?> - <?php echo $_SESSION['email'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <link href="../Style_private/Style_private.css" rel="stylesheet">

    <!--Google fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@200&display=swap" rel="stylesheet">
    <!--Google fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">

</head>

<body>
    <header>
        <div class="container" style="font-family: 'Overpass', sans-serif;">
            <div id="_header">
                <img id="logo" src="../Style_private/logo.png" alt="img">
                <p id="logo-text">Help Desk</p>
            </div>
        </div>
    </header>
    <section id="sec-geral" style="font-family: 'Roboto', sans-serif;">
        <div id="menu-lateral">
            <?php if ($_SESSION['setor'] == "Func") { ?>
                <a href="./Abrir_chamado.php" id="btn-menu"><i class="fa-solid fa-pen-to-square"></i></a>
                <hr>
            <?php } ?>

            <a href="./Chamados.php" id="btn-menu"><i class="fa-regular fa-folder-open"></i></a>
            <hr>
            <a href="../Session_close.php" id="btn-menu"><i class="fa-solid fa-right-to-bracket"></i></a>




        </div>
        <div id="painel-geral-home">
            <img id="img-home" src="../Style_private/logo.png" alt="img"><br>
            Seja bem vindo(a)

        </div>
    </section>

    <script src="https://kit.fontawesome.com/0a2ff8b21c.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>