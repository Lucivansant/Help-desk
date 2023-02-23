<?php
session_start();
require_once './Session_Login_Cadastro/Session.php';

if (isset($_POST['email']) && isset($_POST['senha'])) {

    if (empty($_POST['email']) or empty($_POST['senha'])) {
        header('location: index.php?Login_vazio=TRUE');
    } else {
        $Session_login_func = new Login_func();
        $Return = $Session_login_func->Get_func_API($_POST['email'], $_POST['senha']);
        $Return_json_decode = json_decode($Return);


        if (!empty($Return_json_decode)) {
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['setor'] = 'Func';
            $_SESSION['autenticado'] = 'SIM';


            header('location: ./App/Views_private/Home.php');
        } else {
            $_SESSION['autenticado'] = 'NAO';
            header('location: index.php?Login_invalido=TRUE');
        }
    }
}
?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Help Desk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <link href="./Style_public/Style_public.css" rel="stylesheet">

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
        <div id="_header" class="container" style="font-family: 'Overpass', sans-serif;">
            <div id="logo">
                <img id="img" src="./Style_public/logo.png" alt="img"> Help Desk
            </div>
        </div>
    </header>
    <section id="sec-log-cad" style="font-family: 'Roboto', sans-serif;">
        <div id="card-login">
            <div id="header-card-login">
                <h6 id="text-header-login">Login - help desk</h6>
            </div>
            <div id="body-card-login">
                <form method="POST" action="index.php">
                    <input type="hidden" name="setor" value="funcionario">
                    <input id="input" type="text" name="email" class="form-control" placeholder="E-mail">
                    <input id="input" type="password" name="senha" class="form-control" placeholder="Senha">
                    <button type="submit" class="btn btn-dark">Logar</button>
                    <a href="./Login_adm.php">Sou administrador</a>
                </form>
                <?php if (isset($_GET['Login_vazio']) && $_GET['Login_vazio'] == "TRUE") { ?>
                    <div id="feedback">
                        <p class="text-danger"><b>Digite todos os campos para realizar o login.</b></p>
                    </div>
                <?php } ?>
                <?php if (isset($_GET['Login_invalido']) && $_GET['Login_invalido'] == "TRUE") { ?>
                    <div id="feedback">
                        <p class="text-danger"><b>Login inválido.</b></p>
                    </div>
                <?php } ?>

            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>