<?php
session_start();

if (!isset($_SESSION['email']) && !isset($_SESSION['setor'])) {
    header('location: ../../Index.php?Login=ERROR');
}

require_once '../Script_API/Curl.php';
if (isset($_POST['titulo']) && isset($_POST['option_setor']) && isset($_POST['option_categoria']) && isset($_POST['Desc']) && isset($_POST['status'])) {

    if (empty($_POST['titulo']) or empty($_POST['option_setor']) or empty($_POST['option_categoria']) or empty($_POST['Desc']) or empty($_POST['status'])) {

        header('location: Abrir_chamado.php?Registro=ERRO');
    } else {
        Api::Registra_chamado($_POST['titulo'], $_POST['option_setor'], $_POST['option_categoria'], $_POST['Desc'], $_POST['status'], $_POST['funcionario']);
        header('location: Abrir_chamado.php?Registro=OK');
    }
}
?>
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
            <a href="./Chamados.php" id="btn-menu"> <i class="fa-regular fa-folder-open"></i></a>
            <hr>
            <a href="../Session_close.php" id="btn-menu"><i class="fa-solid fa-right-to-bracket"></i></a>



        </div>
        <div id="painel-geral-abrir-chamado">
            <h5><i class="fa-solid fa-user"></i> - <?php echo $_SESSION['email'] ?></h5>
            <hr>
            <h3>Abertura de chamado</h3>

            <form method="POST" action="./Abrir_chamado.php">
                <input type="hidden" name="funcionario" value="<?php echo $_SESSION['email'] ?>">
                <input type="hidden" name="status" value="Pendente">
                <label>Título</label>
                <input id="input" class="form-control" type="text" name="titulo" placeholder="Título">
                <label>Setor</label>
                <select id="input" class="form-control" name="option_setor">
                    <option>Selecione o setor do problema</option>
                    <option value="Recepção">Recepção</option>
                    <option value="RH">RH</option>
                    <option value="Telemarketing">Telemarketing</option>
                    <option value="Almoxarifado">Almoxarifado</option>
                </select>
                <label>Categoria</label>
                <select id="input" class="form-control" name="option_categoria">
                    <option>Selecione uma categoria</option>
                    <option value="Hardware">Hardware</option>
                    <option value="Software">Software</option>
                    <option value="Rede">Rede</option>
                    <option value="Impressora">Impressora</option>
                </select>
                <label>Descrição</label>
                <textarea id="input" rows="5" cols="5" class="form-control" placeholder="Descrição" name="Desc"></textarea>

                <button type="submit" class="btn btn-dark">Abrir chamado</button>
                <?php if (isset($_GET['Registro']) && $_GET['Registro'] == "OK") { ?>
                    <p class="text-success"><i class="fa-solid fa-check"></i> Chamado realizado... Aguarde um técnico especializado ir até o local.</p>
                <?php } ?>
                <?php if (isset($_GET['Registro']) && $_GET['Registro'] == "ERRO") { ?>
                    <p class="text-danger"><i class="fa-solid fa-xmark"></i> Digite todos os campos para realizar um chamado...</p>
                <?php } ?>
            </form>


        </div>
    </section>

    <script src="https://kit.fontawesome.com/0a2ff8b21c.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>