<?php
session_start();
if (!isset($_SESSION['email']) && !isset($_SESSION['setor'])) {
    header('location: ../../Index.php?Login=ERROR');
}
require_once '../Script_API/Curl.php';
if ($_SESSION['setor'] == "Adm") {
    $Result = Api::Recuperar_todos_registros();
    $Result_decode = json_decode($Result);
} else {
    $Result_chamados = Api::Recuperar_registros($_SESSION['email']);
    $Result_chamados_decode = json_decode($Result_chamados);
}
if (isset($_POST['status']) && isset($_POST['id'])) {
    Api::Atualizar_status($_POST['status'], $_POST['id']);
    header('location: Chamados.php');
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
        <div id="painel-geral-chamados">
            <h5><i class="fa-solid fa-circle-user"></i> - <?php echo $_SESSION['email'] ?></h5>
            <hr>
            <?php if ($_SESSION['setor'] == "Adm") { ?>
                <h3>Todos os chamados abertos</h3>
            <?php } else { ?>
                <h3>Meus chamados</h3>
            <?php } ?>
            <?php if ($_SESSION['setor'] == "Adm") { ?>
                <!--Todos os cards mostrados no painel do adm-->
                <?php foreach ($Result_decode as $Key => $Valor_chamado) { ?>
                    <div id="card-chamados">
                        <div id="card-header-chamado">
                            <h6 id="card-header-chamado-titulo"> - <?php echo $Valor_chamado->titulo ?></h6>
                        </div>
                        <div id="card-body-chamado">
                            <p><b><?php echo $Valor_chamado->funcionario ?></b></p>
                            <h5>Setor: <b><?php echo $Valor_chamado->setor ?></b></h5>
                            <h5>Categoria: <b><?php echo $Valor_chamado->categoria ?></b></h5>
                            <p>Descrição: <b><?php echo $Valor_chamado->descr ?></b></p>
                            <hr>
                            <label>Status:</label>
                            <?php if ($Valor_chamado->status_chamado == "Feito") { ?>
                                <p class="text-success"><i class="fa-solid fa-check"></i> (<?php echo $Valor_chamado->status_chamado ?>)</p>
                            <?php } else { ?>
                                <p class="text-danger"><i class="fa-solid fa-clock"></i> (<?php echo $Valor_chamado->status_chamado ?>)</p>
                            <?php } ?>


                            <?php if ($_SESSION['setor'] == "Adm") { ?>
                                <div id="card-footer-chamado">
                                    <form method="POST" action="Chamados.php">
                                        <input type="hidden" name="id" value="<?php echo $Valor_chamado->id ?>">
                                        <input type="hidden" name="status" value="Feito">
                                        <?php if ($Valor_chamado->status_chamado == "Feito") { ?>
                                            <button type="submit" type="submit" id="btn-card" class="btn btn-success" disabled><i class="fa-solid fa-check"></i> Serviço concluído</button>
                                        <?php } else { ?>
                                            <button type="submit" id="btn-card" class="btn btn-success"><i class="fa-solid fa-handshake"></i> Finalizar serviço</button>
                                        <?php } ?>

                                    </form>

                                </div>
                            <?php } ?>

                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <!--Todos os cards individuais mostrados no painel do funcionário-->
                <?php foreach ($Result_chamados_decode as $Key => $Valor_chamado) { ?>
                    <div id="card-chamados">
                        <div id="card-header-chamado">
                            <h6 id="card-header-chamado-titulo"> - <?php echo $Valor_chamado->titulo ?></h6>
                        </div>
                        <div id="card-body-chamado">
                            <h5>Setor: <b><?php echo $Valor_chamado->setor ?></b></h5>
                            <h5>Categoria: <b><?php echo $Valor_chamado->categoria ?></b></h5>
                            <p>Descrição: <b><?php echo $Valor_chamado->descr ?></b></p>
                            <hr>
                            <label>Status:</label>
                            <?php if ($Valor_chamado->status_chamado == "Feito") { ?>
                                <p class="text-success"><i class="fa-solid fa-check"></i> (<?php echo $Valor_chamado->status_chamado ?>)</p>
                            <?php } else { ?>
                                <p class="text-danger"><i class="fa-solid fa-clock"></i> (<?php echo $Valor_chamado->status_chamado ?>)</p>
                            <?php } ?>


                            <?php if ($_SESSION['setor'] == "Adm") { ?>
                                <div id="card-footer-chamado">
                                    <form method="POST" action="Chamados.php">
                                        <input type="hidden" name="id" value="<?php echo $Valor_chamado->id ?>">
                                        <input type="hidden" name="status" value="Feito">
                                        <?php if ($Valor_chamado->status_chamado == "Feito") { ?>
                                            <button type="submit" type="submit" id="btn-card" class="btn btn-success" disabled><i class="fa-solid fa-check"></i> Serviço concluído</button>
                                        <?php } else { ?>
                                            <button type="submit" id="btn-card" class="btn btn-success"><i class="fa-solid fa-handshake"></i> Finalizar serviço</button>
                                        <?php } ?>

                                    </form>

                                </div>
                            <?php } ?>

                        </div>
                    </div>
                <?php } ?>
            <?php } ?>

        </div>
    </section>

    <script src="https://kit.fontawesome.com/0a2ff8b21c.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>